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
<hr style="border: 1px solid #3C8DBC" >
    <table class="table table-striped table-bordered table-hover" id="pages-table">
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

       {{--  @foreach ($pages as $page)
                <tr>
                    <td><a href="{{route('admin.quiz.page.show' , $page->id)}}">{!! $page->title !!}</a></td>
                    <td>{!! str_limit(strip_tags($page->body) , 50 ) !!}</td>
                    <td>{!! $page->cour->title  !!}</td>
                    <td>{!! $page->created_at->diffForHumans() !!}</td>
                    <td>{!! $page->updated_at->diffForHumans() !!}</td>
                    <td>{!! $page->action_buttons !!}</td>
                </tr>
        @endforeach --}}
            
        </tbody>
    </table>
    <div class="clearfix"></div>
@stop

@section('fc')
<script type="text/javascript">
        $(function() {
            $('#pages-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('datatables.page') !!}',
                aoColumns: [                    
                    { data: 'title', name: 'title'  },
                    { data: 'body', name: 'body' },
                     { data: 'cour.title', name: 'cour.title'   , searchable: false , orderable: false },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action'  , searchable: false}
                ],
                // 'fnServerData': function(sSource, aoData, fnCallback) {                     
                //     $.ajax
                //         ({
                //             'dataType': 'json',
                //             'type': 'POST',
                //             'url': sSource,
                //             'data': aoData,
                //             'success': fnCallback
                //         });
                // },
                "fnDrawCallback": function(oSettings) {
                    deleteCinfirmationButtons();
                }
            });
        });
    </script>
@endsection