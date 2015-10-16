@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Quiz (Qcm) Application
        <small>Gestion des pages et quizs</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="">Gestion des Reponses</li> <li class="active">Creation Reponse</li>
@endsection

@section('content')
    @include('backend.quiz.includes.partials.header-buttons')

    {!! Form::open(['route' => 'admin.quiz.answer.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!}
       
        <div class="form-group">
            {!! Form::label('question_id', 'Cours', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::select('question_id' , $questions , null, ['class'=>'form-control']) !!}
            </div>
        </div><!--form control-->
      

        <div class="form-group">
            {!! Form::label('body', 'Déscription', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Déscription']) !!}
            </div>
        </div><!--form control--> 

        

        <div class="form-group">
            {!! Form::label('type', 'Type', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                 {!! Form::radio('type', true , true) !!} Vrai<br>
                 {!! Form::radio('type', false ) !!} Faux
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