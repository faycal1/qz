@extends('frontend.layouts.master')

@section('content')
	<div class="row">

        <div class="col-md-2">
                <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> Liste des Cours</div>

                <div class="panel-body">
                    <ul class="list-group" >
                       @include('frontend.includes.cours_list')
                    </ul>
                </div>
            </div><!-- panel -->
        </div>
           

		<div class="col-md-10">

			<div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> {{ $cour->title }} </div>
                <div class="panel-body">
                    <h2> {{ $cour->title }} </h2>
                    <p> {{ $cour->body }} </p>

                    
                </div>
            </div><!-- panel -->

		</div><!-- col-md-10 -->

	</div><!-- row -->
@endsection