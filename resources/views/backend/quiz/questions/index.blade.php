@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Quiz (Qcm) Application
        <small>Gestion des quiz</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">Gestion des Questions</li>
@endsection

@section('content')
    @include('backend.quiz.includes.partials.header-buttons')

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>            
            <th>Title</th>
            <th>Description</th>
            <th>Cour</th> 
            <th>Type</th>            
            <th class="visible-lg">Créer</th>
            <th class="visible-lg">Editer</th>
            <th>{{ trans('crud.actions') }}</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($questions as $question)
                <tr>
                    <td><a href="{{route('admin.quiz.question.show' , $question->id)}}">{!! $question->title !!}</a></td>
                    <td>{!! str_limit($question->body , 30) !!}</td>
                    <td>{!! $question->cour->title  !!}</td>
                    <td>{!! $question->type  !!}</td>
                    <td>{!! $question->created_at->diffForHumans() !!}</td>
                    <td>{!! $question->updated_at->diffForHumans() !!}</td>
                    <td>{!! $question->action_buttons !!}</td>
                </tr>
        @endforeach
            
        </tbody>
    </table>

    <div class="pull-left">
        
    </div>

    <div class="pull-right">
        
    </div>

    <div class="clearfix"></div>
@stop