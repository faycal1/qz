@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Quiz (Qcm) Application
        <small>Gestion des cours et quizs</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="">Gestion des Questions</li> <li class="active">{{ $question->title }}</li>
@endsection

@section('content')
    @include('backend.quiz.includes.partials.header-buttons')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="alert alert-info" >{{ $question->title }}</h2>
        </div>
        <div class="panel-body">
            <p>{{ $question->body }}</p>
            <h4  > Type : {{ $question->type }}</h4>
            <h4  > Score : {{ $question->score }}</h4>
            <h4  > Cour : {{ $question->cour->title }}</h4><br>
            <p class="badge badge-success">Crée le {!! $question->created_at->format('d M Y à H:m:i') !!}</p><br>
            <p class="badge badge-warning">Actualisé le {!! $question->updated_at->format('d M Y à H:m:i')  !!}</p>

            <hr>
            <h2 class="alert alert-warning" >Reponses <span class="badge" >{{ count($question->answers) }}</span></h2>
                <ul class="list-group">
                @foreach ($question->answers as $answer)
                    <li class="list-group-item">
                        <p><span class="badge" >Reponse :</span> {{ $answer->body }}</p>            
                        <p><span class="badge" >Type :</span> 
                                  @if ($answer->type == 1)
                                    <span class="label label-success">Vrai</span>                        
                                  @else
                                    <span class="label label-danger">Faux</span>
                                  @endif
                        </p>
                    </li>
                @endforeach
                </ul>
            <hr>
        </div>
    </div>

@endsection

