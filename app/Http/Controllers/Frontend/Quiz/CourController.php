<?php

namespace App\Http\Controllers\Frontend\Quiz;

use DB;
use Auth;
use Redis;
use Response;
use Illuminate\Http\Request;
use App\Models\Quiz\Cour\Cour;
use App\Models\Quiz\Page\Page;
use App\Services\Quiz\QuizService;
use App\Http\Controllers\Controller;
use App\Models\Quiz\Question\Question;

class CourController extends Controller
{

    public function index()
    {
        if (!is_null(Cour::first())) {
            $cour = Cour::first();
        } else {
            $cour = [];
        }
        return view('frontend.quiz.cours.list', compact('cour'));
    }

    public function show($slug)
    {
        
        $cour = Cour::where('slug', $slug)->get()->first();

        return view('frontend.quiz.cours.show', compact('cour'));
    }

    public function showCourPage($slug, $slugp)
    {
        $cour = Cour::where('slug', $slug)->get()->first();
        $page = Page::where('slug', $slugp)->get()->first();

        return view('frontend.quiz.cours.showPage', compact('cour', 'page'));
    }

    public function showCourQuiz($slug)
    {
        Redis::flushall();
        $cour = Cour::where('slug', $slug)->get()->first();
        //$question = Question::where('slug', $slugq)->get()->first();
        $question = '';

        return view('frontend.quiz.cours.showQuiz', compact('cour',  'question'));
    }

    public function paresXml($slug)
    {
        $QuizService = new QuizService();
        $cours = Cour::where('slug', $slug)->get()->first();
        $timer = $cours->timer == '1' ? 'true' : 'false';

        $output = '<?xml version="1.0" encoding="utf-8" ?>
                    <data>                           
                      '.$QuizService::XmlEvents().'      
                     <box id="failbg" position="absolute" x="0" y="0" width="100%" height="100%" anim="hide" class="failbg" />
                        <box id="orangebg" position="absolute" x="0" y="0" width="100%" height="100%" anim="hide" class="" />
                        <!--responsive timer-->
                        <!--2 column layout, timer on the right, moves to top center on phones-->
                        <box id="timerRow" position="absolute" x="0" y="0" anim="none" animtime="0.5" animdelay="1" class="col-md-8 col-md-offset-4">
                            <box id="timerCol1" position="relative" class="col-md-6" />
                            <box id="timerContainer" position="relative" class="col-md-6" />
                        </box>
                        <!--opening text-->
                        <box id="openingText" position="relative" anim="left" animtime="0.5" animdelay="1" class="col-md-8 col-md-offset-2 vertical-align" z-index="3">
                            <text id="title" position="relative" margin-top="300" anim="none"><![CDATA[<p class="p_16_black">Bienvenu au Quiz du cours .</p><h1 class="black">'.$cours->title.'</h1>]]></text>
                            <button id="goBtn" position="relative" height="40" width="120" margin-top="40" margin-bottom="20" anim="none" event="btnover,begin" target="title"><![CDATA[Commencez !]]></button>
                        </box>

                        <!--timed quiz-->
                        <custom type="quiz" id="quiz" position="relative" x="0" y="0" class="col-md-10 col-md-offset-1">
                            <settings timer="'.$timer.'" timerx="0" timery="0"/>                           
                               '.$QuizService->XmlQuestions($cours).'
                            <!--generic timeout text-->
                            <timeout>
                                <box id="center" position="relative" height="100%"> 
                                    <box id="timeOut" position="relative" height="210" margin-top="200" margin-bottom="20" anim="left" animtime="1" ease="Bounce.easeOut" class="col-sm-8 col-sm-offset-2 vertical-align border timesupbg">
                                        <text id="timeoutTxt" position="relative" x="10" margin-top="30" margin-bottom="20" anim="none">
                                            <![CDATA[<p class="p_42 grey">Fin du temps!</p>]]>
                                        </text>                                
                                        <button id="startAgainBtn" position="relative" x="10" margin-bottom="30" height="40" width="100" anim="none" event="btnover,restart"><![CDATA[Refaire]]></button>
                                    </box>
                                </box>
                            </timeout>
                            <!--score screen-->
                            '.$QuizService::XmlScore().'
                        </custom>
                    </data>';

        return Response::make($output, '200')->header('Content-Type', 'text/xml');
    }

    public function quiz(Request $request)
    {
        $id = $request->id;
        $passed = $request->passed;
        $cour_id = Question::findOrFail($id)->cour_id;
        $cour = Cour::findOrFail($cour_id);

        $user = Auth::user();

        $redisname = $id.'-'.$cour_id.'-quiz' ;

        if (Redis::get($redisname)) {
            $quiz = unserialize(Redis::get($redisname));
            $question = ['id' => $id , 'passed' => $passed];

            foreach ($quiz['question'] as $key => $value) {
                if ($value['id'] == $id) {
                    unset($quiz['question'][$key]);
                }
            }

            array_push($quiz['question'], $question);

            $redis = Redis::set($redisname, serialize($quiz));

        } else {

            $quiz = ['question' => []];
            $question = ['id' => $id , 'passed' => $passed];
            array_push($quiz['question'], $question);
            $redis = Redis::set($redisname , serialize($quiz));
        }
  
        if (!is_null($cour->quizsHasUsers(  $cour_id ,$user->id))) {
            DB::table('cour_user')->where('user_id', $user->id)
                                  ->where('cour_id', $cour_id)
                                  ->update(['result' => Redis::get($redisname), 'score' => $request->score]);    

        } else {
            $user->cours()->attach([$cour_id => ['result' => Redis::get($redisname), 'score' => $request->score]]);
        }

        return  response()->json(['data' => Redis::get($redisname), 'unserialize' => unserialize(Redis::get($redisname))]);
    }

    
}
