@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Quiz (Qcm) Application
        <small>Gestion Departements</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="">Gestion des Departements</li> <li class="active">Edition Département</li>
@endsection

@section('content')
    @include('backend.departement.includes.partials.header-buttons')   

    {!! Form::model( $departement ,['route' => ['admin.departement.update' , $departement->id ], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'patch']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Nom', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
            </div>
        </div><!--form control-->

        <div class="well">            

            <div class="pull-right">
                <input type="submit" class="btn btn-success btn-xs" value="{{ trans('strings.save_button') }}" />
            </div>
            <div class="clearfix"></div>
        </div><!--well-->  

    {!! Form::close() !!}

@endsection