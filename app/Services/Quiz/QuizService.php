<?php

namespace App\Services\Quiz;

/**
 * summary.
 */
class QuizService
{
    /**
     * summary.
     */
    public function __construct()
    {
    }

    public static function XmlEvents()
    {
        $events = '<events>
                <event id="btnover">
                    <rollover>
                        <css name="btnOverCss">this</css>
                    </rollover>
                    
                    <rollout>
                        <css name="btnOutCss">this</css>
                    </rollout>
                </event>

                <event id="optionover">
                    <rollover>
                        <css name="optionOverCss">this</css>
                    </rollover>
                    
                    <rollout>
                        <css name="optionOutCss">this</css>
                    </rollout>
                </event>
                
                <event id="selectandsubmit">
                    <click>
                        <css name="optionOverCss">this</css>
                        <function name="select">this</function>
                        <function name="submit">this</function>
                    </click>
                </event>

                <event id="select">
                    <click>
                        <css name="optionOverCss">this</css>
                        <function name="select">this</function>
                    </click>
                </event>

                <event id="submit">
                    <click>
                        <function name="submit">this</function>
                    </click>
                </event>

                <event id="reset">
                    <click>
                        <function name="reset">this</function>
                    </click>
                </event>
                
                <event id="begin">
                    <click>
                        <anim type="remove" animtime="0" oncomplete="0">openingText</anim>
                        <function name="begin">this</function>
                    </click>
                </event>

                <event id="loadNextQuestion">
                    <click>
                        <function name="loadNextQuestion">this</function>
                    </click>
                </event>
                
                 <event id="restart">
                    <click>
                        <function name="restart">this</function>
                    </click>
                </event>

                <event id="showq1bg">
                    <click>
                        <anim type="show" animtime="2" oncomplete="0">q1bg</anim>
                    </click>
                </event>

                 <event id="hidepassbg">
                    <click>
                        <anim type="hide" animtime="2" oncomplete="0">passbg</anim>
                    </click>
                </event>

                <event id="showpassbg">
                    <click>
                        <anim type="show" animtime="5" oncomplete="0">passbg</anim>
                    </click>
                </event>

                <event id="hidefailbg">
                    <click>
                        <anim type="hide" animtime="2" oncomplete="0">failbg</anim>
                    </click>
                </event>

                <event id="showfailbg">
                    <click>
                        <anim type="show" animtime="2" oncomplete="0">failbg</anim>
                    </click>
                </event>
            </events> ';

        return $events;
    }

    public function XmlQuestions($collection)
    {
        $questions = '';

        foreach ($collection->questions as $value) {
            $questions .=  $this->QuestionContainer($value);
        }

        return $questions;
    }

    private function QuestionContainer($data)
    {
        $time = $data->time ? $data->time : '15';

        $QuestionContainer = '
    		<question id="'.$data->id.'" time="'.$time.'" event="">
                    <box id="col1" position="relative" class="col-md-8" />
                    <box id="col2" position="relative" class="col-md-4" />
	                    <text id="question'.$data->id.'" position="relative" target="col1" x="0" margin-top="10" margin-bottom="100" anim="left" animtime="0.5">
	                    	<![CDATA[
	                    		<h2>'.$data->title.'</h2>
	                    		<p class="p_24">'.$data->body.'</p>
	                    	]]>
	                    </text>	 
	                    '.$this->AnswersContainer($data->answers, $data->type).' 
	                    '.$this->FbContainer($data->pass, $data->fail, $data->partial, $data->type).' 	                     
            </question>';

        return $QuestionContainer;
    }

    private function AnswersContainer($collection, $type)
    {
        $options = '';
        foreach ($collection as $value) {
            $answertype = $value->type == '1' ? 'true' : 'false';
            $typeSubmit = $type == 'multiple' ? 'select'  : 'selectandsubmit';
            $options .= '
    			<option correct="'.$answertype.'">
                    <text id="option'.$value->question_id.'_'.$value->id.'" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.5" event="optionover,'.$typeSubmit.'" class="optionBox">
                    	<![CDATA[<p class="p_16 white cent">'.$value->body.'</p>]]>
                    </text>
                </option>';
        }

        return $options;
    }

    private function FbContainer($pass, $fail, $partial, $type)
    {
        if ($type == 'multiple') {
            $buttonPartial =
            '<button id="submitBtn" position="relative" target="col1" x="match" float="left" width="100" anim="disabled" animtime="0.3" animdelay="0.7" event="btnover,submit"><![CDATA[<p class="genericBtn">Confirmez</p>]]></button>
            <button id="resetBtn" position="relative" target="col1" x="match" float="left" margin-left="10" margin-bottom="40" width="100" anim="disabled" animtime="0.3" animdelay="0.7" event="btnover,reset"><![CDATA[<p class="genericBtn">Videz</p>]]></button>
            ';
        } else {
            $buttonPartial = '';
        }

        if ($type == 'multiple') {
            $fbPartial =
            ' <fb id="partial" event="">  
                <box id="fb" position="relative" target="col2" x="0" margin-top="20" clear="both" anim="show" animtime="0.5">                    
                    <text id="txt11" position="relative" anim="none" margin-bottom="30">
                    	<![CDATA[<p class="p_24">'.$partial.'</p>]]>
                    </text>            
                    <button id="nextQBtn" position="relative" margin-bottom="10" width="150" anim="none" event="btnover,loadNextQuestion"><![CDATA[Suivant]]></button>
                    <text id="bottompad" position="relative" anim="none">
                    	<![CDATA[<p>&nbsp;</p>]]>
                    </text>
                </box>
            </fb>';
        } else {
            $fbPartial = '';
        }

        $fb = $buttonPartial.' 
    		<fb id="pass" event="">
                <box id="fb" position="relative" target="col2" margin-top="20" clear="both" anim="show" animtime="0.5">                                
                    <text id="txt1" position="relative" anim="none" margin-bottom="30">
                    	<![CDATA[<p class="p_24">Correct!</p>
                            		<p>'.$pass.'</p>]]>
                    </text>            
                    <button id="nextQBtn" position="relative" width="150" margin-bottom="10" anim="none" event="btnover,loadNextQuestion"><![CDATA[Suivant]]></button>
                    <text id="bottompad" position="relative" anim="none">
                    	<![CDATA[<p>&nbsp;</p>]]>
                    </text>
                </box>
            </fb>

           '.$fbPartial.'
                    
            <fb id="fail" event=""> 
                <box id="fb" position="relative" target="col2" margin-top="20" clear="both" anim="show" animtime="0.5">                                
                    <text id="txt1" position="relative" anim="none" margin-bottom="30">
                    	<![CDATA[<p class="p_24">Non !</p>
                    	<p>'.$fail.'</p>]]></text>
            
                    <button id="nextQBtn" position="relative" width="150" margin-bottom="10" anim="none" event="btnover,loadNextQuestion"><![CDATA[Suivant]]></button>
                    <text id="bottompad" position="relative" anim="none"><![CDATA[<p>&nbsp;</p>]]></text>
                </box>
            </fb>';

        return $fb;
    }

    public static function XmlScore($congrat = 'Felicitations')
    {
        $score = '
    		<score masteryscore="80">
               <fb id="pass" event="">
                    <box id="center" position="relative" height="100%">
                        <box id="passTextBox" position="relative" height="250" margin-top="200" margin-bottom="20" anim="left" animtime="0.5" class="col-sm-8 col-sm-offset-2 vertical-align border passbg">                            
                            <text id="pass_txt" position="relative" x="10" margin-top="30" margin-bottom="20" anim="none">
                            <![CDATA[<p class="p_30 white glow">'.$congrat.'!</p><p class="p_24 green glow">Votre Score [score]%</p>]]></text>                            
                            <button id="goBtn" position="relative" x="10" margin-bottom="30" height="40" width="140" anim="none" event="btnover,restart,hidepassbg"><![CDATA[Refaire ?]]></button>
                        </box>
                    </box>
                </fb>                
                <fb id="fail" event="">
                <box id="center" position="relative" height="100%">
                        <box id="failTextBox" position="relative" height="250" margin-top="200" margin-bottom="20" anim="left" animtime="0.5" class="col-sm-8 col-sm-offset-2 vertical-align border failbg">
                            <text id="fail_txt" position="relative" x="10" margin-top="30" margin-bottom="20" anim="none">
                                <![CDATA[<p class="p_32 white glow">Pas de chance! Votre Score [score]%</p><p class="p_24 green glow">Pourquoi pas refaire :) ?</p>]]>
                            </text>                                
                            <button id="goBtn" position="relative" x="10" margin-bottom="30" height="40" width="120" anim="none" animtime="0.5" event="btnover,restart,hidefailbg"><![CDATA[Refaire]]></button>
                        </box> 
                    </box> 
                </fb>
            </score>';

        return $score;
    }
}
