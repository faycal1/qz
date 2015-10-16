@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Quiz (Qcm) Application
        <small>Gestion des cours et quizs</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="">Gestion des Categories</li> <li class="active">Creation catégorie</li>
@endsection

@section('content')
    @include('backend.quiz.includes.partials.header-buttons')
   

    {!! Form::model( $answer ,['route' => ['admin.quiz.answer.update' , $answer->id ], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'patch']) !!}

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
            {!! Form::label('score', 'Score', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::text('score', null, ['class' => 'form-control', 'placeholder' => 'Score']) !!}
            </div>
        </div><!--form control-->

        <div class="form-group">
            {!! Form::label('type', 'Type', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                 {!! Form::radio('type', 1 ) !!} Vrai<br>
                 {!! Form::radio('type', 0 ) !!} Faux
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