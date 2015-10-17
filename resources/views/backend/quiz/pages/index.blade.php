@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Quiz (Qcm) Application
        <small>Gestion des quiz</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">Gestion des Pages</li>
@endsection

@section('content')
    @include('backend.quiz.includes.partials.header-buttons')

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>            
            <th>Title</th>
            <th>Description</th>
            <th>Cour</th>            
            <th class="visible-lg">Créer</th>
            <th class="visible-lg">Editer</th>
            <th>{{ trans('crud.actions') }}</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($pages as $page)
                <tr>
                    <td><a href="{{route('admin.quiz.page.show' , $page->id)}}">{!! $page->title !!}</a></td>
                    <td>{!! str_limit($page->body , 30) !!}</td>
                    <td>{!! $page->cour->title  !!}</td>
                    <td>{!! $page->created_at->diffForHumans() !!}</td>
                    <td>{!! $page->updated_at->diffForHumans() !!}</td>
                    <td>{!! $page->action_buttons !!}</td>
                </tr>
        @endforeach
            
        </tbody>
    </table>

    <div class="pull-left">
        
    </div>

    <div class="pull-right">
        {!! $pages->render() !!}
    </div>

    <div class="clearfix"></div>
@stop