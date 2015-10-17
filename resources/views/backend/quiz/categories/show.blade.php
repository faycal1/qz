@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Quiz (Qcm) Application
        <small>Gestion des cours et quizs</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="">Gestion des Categories</li> <li class="active">{{ $category->title }}</li>
@endsection

@section('content')
    @include('backend.quiz.includes.partials.header-buttons')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="alert alert-info" >{{ $category->title }}</h2>
        </div>
        <div class="panel-body">
            <p>{{ $category->body }}</p>
            <p class="badge badge-success">Crée le {!! $category->created_at->format('d M Y à H:m:i') !!}</p><br>
            <p class="badge badge-warning">Actualisé le {!! $category->updated_at->format('d M Y à H:m:i')  !!}</p>
        </div>
    </div>
@endsection