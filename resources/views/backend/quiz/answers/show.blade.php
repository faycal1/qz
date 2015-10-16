@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Quiz (Qcm) Application
        <small>Gestion des cours et quizs</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="">Gestion des Reponses</li> <li class="active">{{ $answer->question->title }}</li>
@endsection

@section('content')

    

    @include('backend.quiz.includes.partials.header-buttons')
    <p><span class="badge badge-success" >Question :</span> {{ $answer->question->title }}</p>
    <p><span class="badge badge-success" >Reponse  :</span> {{  $answer->body }}</p>
    <p><span class="badge badge-success" >Type  :</span> {{  $answer->type }}</p>
    <p><span class="badge badge-success" >Score  :</span> {{  $answer->score }}</p>
     <p class="badge badge-success">Crée le {!! $answer->created_at->format('d M Y à H:m:i') !!}</p><br>
    <p class="badge badge-warning">Actualisé le {!! $answer->updated_at->format('d M Y à H:m:i')  !!}</p>


@endsection

