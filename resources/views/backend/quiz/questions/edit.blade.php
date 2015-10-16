@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Quiz (Qcm) Application
        <small>Gestion des cours et quizs</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="">Gestion des Questions</li> <li class="active">Edition D'une Question</li>
@endsection

@section('content')
    @include('backend.quiz.includes.partials.header-buttons')
   

    {!! Form::model( $question ,['route' => ['admin.quiz.question.update' , $question->id ], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'patch']) !!}

        <div class="form-group">
            {!! Form::label('cour_id', 'Cours', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::select('cour_id' , $cours , null, ['class'=>'form-control']) !!}
            </div>
        </div><!--form control-->

        <div class="form-group">
            {!! Form::label('type', 'Type', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::select('type' , [ ''=>'Type' ,'one'=>'Unique','multiple'=>'Multiple'] , null, ['class'=>'form-control']) !!}
            </div>
        </div><!--form control-->

        <div class="form-group">
            {!! Form::label('title', 'Titre', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Titre']) !!}
            </div>
        </div><!--form control-->

        <div class="form-group">
            {!! Form::label('body', 'Déscription', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Déscription']) !!}
            </div>
        </div><!--form control--> 

         <div class="form-group">
            {!! Form::label('score', 'Score', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::text('score', null, ['class' => 'form-control', 'placeholder' => 'Score']) !!}
            </div>
        </div><!--form control-->

        <div class="well">            

            <div class="pull-right">
                <input type="submit" class="btn btn-success btn-xs" value="{{ trans('strings.save_button') }}" />
            </div>
            <div class="clearfix"></div>
        </div><!--well-->  

    {!! Form::close() !!}

@endsection