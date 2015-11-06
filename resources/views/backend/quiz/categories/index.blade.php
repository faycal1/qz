@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Quiz (Qcm) Application
        <small>Gestion des cours et quizs</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">Gestion des Categories</li>
@endsection

@section('content')
    @include('backend.quiz.includes.partials.header-buttons')

    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
               <th>Title</th>
                <th>Description</th>            
                <th class="visible-lg">Créer</th>
                <th class="visible-lg">Editer</th>
                <th>{{ trans('crud.actions') }}</th>
            </tr>
        </thead>
    </table>

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>            
            <th>Title</th>
            <th>Description</th>            
            <th class="visible-lg">Créer</th>
            <th class="visible-lg">Editer</th>
            <th>{{ trans('crud.actions') }}</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($categories as $category)
                <tr>
                    <td><a href="{{route('admin.quiz.category.show' , $category->id)}}">{!! $category->title !!}</a></td>
                    <td>{!! str_limit($category->body , 30) !!}</td>
                    <td>{!! $category->created_at->diffForHumans() !!}</td>
                    <td>{!! $category->updated_at->diffForHumans() !!}</td>
                    <td>{!! $category->action_buttons !!}</td>
                </tr>
        @endforeach
            
        </tbody>
    </table>

    <div class="pull-left">
        
    </div>

    <div class="pull-right">
        {!! $categories->render() !!}
    </div>

    <div class="clearfix"></div>
@stop

@section('fc')
   <script type="text/javascript">
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('datatables.data') !!}',
        columns: [
            
            { data: 'title', name: 'title' },
            { data: 'body', name: 'body' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'created_at', name: 'created_at' }
        ]
    });
});
</script>
@endsection