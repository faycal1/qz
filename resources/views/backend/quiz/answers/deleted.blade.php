@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Quiz (Qcm) Application
        <small>Gestion Quiz</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">Gestion des Reponses</li><li class="active">Reponses Suprimées</li>
@endsection

@section('content')
    @include('backend.quiz.includes.partials.header-buttons')

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>            
            <th>Reponce</th>
                       
            <th class="visible-lg">Créer</th>
            <th class="visible-lg">Editer</th>
            <th>{{ trans('crud.actions') }}</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($answers as $answer)
                <tr>                    
                    <td>{!! str_limit($answer->body , 30) !!}</td>
                    <td>{!! $answer->created_at->diffForHumans() !!}</td>
                    <td>{!! $answer->updated_at->diffForHumans() !!}</td>
                    <td>{!! $answer->action_deleted_buttons !!}</td>
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