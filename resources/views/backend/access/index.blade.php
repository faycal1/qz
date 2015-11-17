@extends ('backend.layouts.master')

@section ('title', trans('menus.user_management'))

@section('page-header')
    <h1>
        {{ trans('menus.user_management') }}
        <small>{{ trans('menus.active_users') }}</small>
    </h1>
@endsection

@section ('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">{!! link_to_route('admin.access.users.index', trans('menus.user_management')) !!}</li>
@stop

@section('content')
    @include('backend.access.includes.partials.header-buttons')

    <table class="table table-striped table-bordered table-hover" id="users-table">
        <thead>
        <tr>            
            <th>{{ trans('crud.users.name') }}</th>
            <th>{{ trans('crud.users.email') }}</th>
            <th>{{ trans('crud.users.confirmed') }}</th>
            <th>{{ trans('crud.users.roles') }}</th>
            <th>Quiz Passé</th>
            {{-- <th>{{ trans('crud.users.other_permissions') }}</th> --}}
            <th>Département</th>
            {{-- <th class="visible-lg">{{ trans('crud.users.created') }}</th> --}}
            {{-- <th class="visible-lg">{{ trans('crud.users.last_updated') }}</th> --}}
            <th>{{ trans('crud.actions') }}</th>
        </tr>
        </thead>
        <tbody>
           
        </tbody>
    </table>

 

    <div class="clearfix"></div>
@stop

@section('fc')
   <script type="text/javascript">
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverside: true,
                ajax: '{!! route('datatables.users') !!}',
                columns: [                    
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'confirmed', name: 'confirmed' },
                    { data: 'role', name: 'role' },
                    { data: 'quiz', name: 'quiz' },
                    { data: 'departement', name: 'departement' },
                    { data: 'action', name: 'action' }
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