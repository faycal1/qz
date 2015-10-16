@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Quiz (Qcm) Application
        <small>Gestion des pages et quizs</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="">Gestion des Pages</li> <li class="active">Creation Page</li>
@endsection

@section('content')
    @include('backend.quiz.includes.partials.header-buttons')

    {!! Form::open(['route' => 'admin.quiz.page.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!}
       
        <div class="form-group">
            {!! Form::label('cour_id', 'Cours', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::select('cour_id' , $cours , null, ['class'=>'form-control']) !!}
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

        <div class="well">            

            <div class="pull-right">
                <input type="submit" class="btn btn-success btn-xs" value="{{ trans('strings.save_button') }}" />
            </div>
            <div class="clearfix"></div>
        </div><!--well-->  

    {!! Form::close() !!}

@endsection