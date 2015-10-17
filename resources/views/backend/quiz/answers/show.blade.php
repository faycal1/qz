@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Quiz (Qcm) Application
        <small>Gestion des cours et quizs</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="">Gestion des Reponses</li> <li class="active">{{ str_limit($answer->body , 20) }}</li>
@endsection

@section('content')

    @include('backend.quiz.includes.partials.header-buttons')

    <div class="panel panel-default">
        <div class="panel-heading">
            <p><span class="badge badge-success" >Question :</span> {{ $answer->question->title }}</p>
        </div>
        <div class="panel-body">
            <p><span class="badge badge-success" >Reponse  :</span> {{  $answer->body }}</p>
            <p><span class="badge badge-success" >Type  :</span> 

                                 @if ($answer->type == 1)
                                    <span class="label label-success">Vrai</span>                        
                                  @else
                                    <span class="label label-danger">Faux</span>
                                  @endif
            </p>            
            <p class="badge badge-success">Crée le {!! $answer->created_at->format('d M Y à H:m:i') !!}</p><br>
            <p class="badge badge-warning">Actualisé le {!! $answer->updated_at->format('d M Y à H:m:i')  !!}</p>
        </div>
    </div>
@endsection

