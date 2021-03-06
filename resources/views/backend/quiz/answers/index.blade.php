@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Quiz (Qcm) Application
        <small>Gestion des quiz</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">Gestion des Reponses</li>
@endsection

@section('content')
    @include('backend.quiz.includes.partials.header-buttons')

    <table class="table table-striped table-bordered table-hover" id="answers-table">
        <thead>
        <tr>   
            <th>Question</th>          
            <th>Reponse</th>
            <th>Type</th>
                                  
            <th class="visible-lg">Créer</th>
            <th class="visible-lg">Editer</th>
            <th>{{ trans('crud.actions') }}</th>
        </tr>
        </thead>
        <tbody>

     {{--    @foreach ($answers as $answer)
                <tr>
                    <td>{!! $answer->question->title  !!}</td>
                    <td><a href="{{route('admin.quiz.answer.show' , $answer->id)}}">{!! str_limit($answer->body , 30) !!}</a></td>
                    <td>{!! $answer->type == 1 ? 'Vrai' : 'Faux' !!}</td>                    
                    <td>{!! $answer->created_at->diffForHumans() !!}</td>
                    <td>{!! $answer->updated_at->diffForHumans() !!}</td>
                    <td>{!! $answer->action_buttons !!}</td>
                </tr>
        @endforeach --}}
            
        </tbody>
    </table>

{{--     <div class="pull-left">
        
    </div>

    <div class="pull-right">
        {!! $answers->render() !!}
    </div> --}}

    <div class="clearfix"></div>
@stop

@section('fc')
<script type="text/javascript">
        $(function() {
            $('#answers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('datatables.answer') !!}',
                aoColumns: [
                     { data: 'question.title', name: 'question.title'   , searchable: false , orderable: false },
                     { data: 'body', name: 'body' },
                     { data: 'type', name: 'type'  },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action'  , searchable: false}
                ],              
                "fnDrawCallback": function(oSettings) {
                    deleteCinfirmationButtons();
                }
            });
        });
    </script>
@endsection