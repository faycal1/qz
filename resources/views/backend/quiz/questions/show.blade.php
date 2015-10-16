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



    <h2>{{ $question->title }}</h2>
    <p>{{ $question->body }}</p>
    <h4 class="badge" > Cour : {{ $question->cour->title }}</h4><br>

    <p class="badge badge-success">Crée le {!! $question->created_at->format('d M Y à H:m:i') !!}</p><br>
    <p class="badge badge-warning">Actualisé le {!! $question->updated_at->format('d M Y à H:m:i')  !!}</p>


@endsection

