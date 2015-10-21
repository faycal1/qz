@extends('frontend.layouts.master')

@section('content')
	<div class="row">
        <div class="col-md-2">
                <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> Liste des Cours</div>
                <div class="panel-body">
                    @include('frontend.includes.cours_list')
                </div>
            </div><!-- panel -->
        </div>           

       <div class="col-md-8">

              <div id="quizContainer"  class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> Quiz  : {{ $cour->title }} </div>
                <div class="panel-body" >

                                  <div id="container" style="width:95%;height:100%;"></div>                    
                    
                </div>
            </div><!-- panel -->

           <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> {{ $cour->title }} </div>
                <div class="panel-body">
                    <h2> {{ $cour->title }} </h2>
                    <p> {{ $cour->body }} </p>                    
                </div>
            </div><!-- panel -->
           
      
            

		</div><!-- col-md-10 -->

        <div class="col-md-2">

        <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> Quiz </div>
                <div class="panel-body">
                   @include('frontend.includes.quiz_list')            
                </div>
            </div><!-- panel -->
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> Liste des Pages </div>
                <div class="panel-body">
                   @include('frontend.includes.pages_list')     
                </div>
            </div><!-- panel -->

            
        </div><!-- col-md-10 -->

        

	</div><!-- row -->
@endsection

@section('quizJs')
               <script type="text/javascript">
                            var quiz;
                            function init(){                                
                                //create the screen object which loads the xml and creates all screen elements
                                quiz = new Screen({id:"myQuiz", xmlPath:"http://localhost:8000/pxml/{{ $cour->slug }}"});                                
                                //choose a target div
                                var targetDiv = get("container");                                
                                //load it
                                quiz.load(targetDiv,false);
                            }                            
                            //kick off
                            jQuery(document).ready(function() {
                                init();
                            });                            
                </script>
@endsection