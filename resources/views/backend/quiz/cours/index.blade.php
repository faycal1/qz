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
     <hr style="border: 1px solid #3C8DBC" >
     <table class="table table-bordered" id="cours-table">
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

    <div class="clearfix"></div>
@stop

@section('fc')
<script type="text/javascript">
        $(function() {
            $('#cours-table').DataTable({
                processing: true,
                bServerSide: true,
                sAjaxSource: '{!! route('datatables.cour') !!}',
                aoColumns: [
                    
                    { data: 'title', name: 'title' },
                    { data: 'body', name: 'body' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' }
                ],
                'fnServerData': function(sSource, aoData, fnCallback) {                     
                    $.ajax
                        ({
                            'dataType': 'json',
                            'type': 'POST',
                            'url': sSource,
                            'data': aoData,
                            'success': fnCallback
                        });
                },
                "fnDrawCallback": function(oSettings) {
                    deleteCinfirmationButtons();
                }
            });
        });
    </script>
@endsection