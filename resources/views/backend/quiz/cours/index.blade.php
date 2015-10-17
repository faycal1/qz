@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Quiz (Qcm) Application
        <small>Gestion des quiz</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">Gestion des Cours</li>
@endsection

@section('content')
    @include('backend.quiz.includes.partials.header-buttons')

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>            
            <th>Title</th>
            <th>Description</th>
            <th>Categorie</th>            
            <th class="visible-lg">Créer</th>
            <th class="visible-lg">Editer</th>
            <th>{{ trans('crud.actions') }}</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($cours as $cour)
                <tr>
                    <td><a href="{{route('admin.quiz.cour.show' , $cour->id)}}">{!! $cour->title !!}</a></td>
                    <td>{!! str_limit($cour->body , 30) !!}</td>
                    <td>{!! $cour->category->title  !!}</td>
                    <td>{!! $cour->created_at->diffForHumans() !!}</td>
                    <td>{!! $cour->updated_at->diffForHumans() !!}</td>
                    <td>{!! $cour->action_buttons !!}</td>
                </tr>
        @endforeach
            
        </tbody>
    </table>

    <div class="pull-left">
        
    </div>

    <div class="pull-right">
        {!! $cours->render() !!}
    </div>

    <div class="clearfix"></div>
@stop