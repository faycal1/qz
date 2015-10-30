@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Quiz (Qcm) Application
        <small>Gestion des cours et quizs</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="">Gestion des Cour</li> <li class="active">{{ $cour->title }}</li>
@endsection

@section('content')
    @include('backend.quiz.includes.partials.header-buttons')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="alert alert-info" >{{ $cour->title }}</h2>
        </div>
        <div class="panel-body"> 
        <p>{{ $cour->body }}</p>
            <h4 class="badge" > Catégorie : {{ $cour->category->title }}</h4><br>

            <p class="badge badge-success">Crée le {!! $cour->created_at->format('d M Y à H:m:i') !!}</p>
            <p class="badge badge-warning">Actualisé le {!! $cour->updated_at->format('d M Y à H:m:i')  !!}</p>
        </div>
    
    </div>
    <div class="row" >
        
    
    <div class="col-md-6" >
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="alert alert-info" >Pages <span class="badge pull-right" >{{ count($cour->pages) }}</span></h2>
            </div>
            <div class="panel-body">
                @foreach ($cour->pages as $page)
                    <p><span class="badge" >Page :</span> {{ $page->title }}</p>
                @endforeach    
            </div>
        </div>
    </div>
    <div class="col-md-6" >
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="alert alert-info" >Questions <span class="badge pull-right" >{{ count($cour->questions) }}</span></h2>
            </div> 
            <div class="panel-body">     
              @foreach ($cour->questions as $question)            
                    <p><span class="badge" >Question :</span> {{ $question->title }}</p>            
                     <p><span class="badge" >Type :</span> @if ($question->type == 'one')
                                                            <span class="label label-success">Une Seule reponse possible</span>
                                                           @else
                                                            <span class="label label-danger">Plusieurs reponses possibles</span>
                                                           @endif
                    </p>
                    <p><span class="badge" >Score :</span> {{ $question->score }}</p>
              @endforeach 
            </div> 
        </div>
    </div>
    </div>
@endsection

