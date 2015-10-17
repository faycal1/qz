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
			<div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> {{ $cour->title }} </div>
                <div class="panel-body">
                    <h2> {{ $cour->title }} </h2>
                    <p> {{ $cour->body }} </p>                    
                </div>
            </div><!-- panel -->
           
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> {{ $question->title }} </div>
                <div class="panel-body">
                    <h2> {{ $question->title }} </h2>
                    <p> {{ $question->body }} </p> 

                    <ul class="list-group" >
                        @foreach ($question->answers as $answer)
                            <li class="list-group-item " >
                                <p> {{ $answer->body }} </p>
                            </li> 
                        @endforeach 
                    </ul> 
                </div>
            </div><!-- panel -->
            

		</div><!-- col-md-10 -->

        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> Liste des Pages </div>
                <div class="panel-body">
                   @include('frontend.includes.pages_list')     
                </div>
            </div><!-- panel -->

            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> Quiz </div>
                <div class="panel-body">
                   @include('frontend.includes.quiz_list')            
                </div>
            </div><!-- panel -->
        </div><!-- col-md-10 -->

        

	</div><!-- row -->
@endsection