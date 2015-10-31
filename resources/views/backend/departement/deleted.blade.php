@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Quiz (Qcm) Application
        <small>Gestion des cours et quizs</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">Gestion des Categories</li><li class="active">Categories Suprimées</li>
@endsection

@section('content')
    @include('backend.departement.includes.partials.header-buttons')

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>            
            <th>Title</th>
                   
            <th class="visible-lg">Créer</th>
            <th class="visible-lg">Editer</th>
            <th>{{ trans('crud.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($departements as $departement)
                <tr>
                    <td><a href="{{route('admin.departement.show' , $departement->id)}}">{!! $departement->name !!}</a></td>                    
                    <td>{!! $departement->created_at->diffForHumans() !!}</td>
                    <td>{!! $departement->updated_at->diffForHumans() !!}</td>
                    <td>{!! $departement->action_deleted_buttons !!}</td>
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