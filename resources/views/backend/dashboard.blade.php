@extends('backend.layouts.master')

@section('page-header')
    <h1>
        Quiz (Qcm) Application
        <small>{{ trans('strings.backend.dashboard_title') }}</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">{{ trans('strings.here') }}</li>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">{{ trans('strings.backend.WELCOME') }} {!! auth()->user()->name !!}!</h3>
          <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            
            <div id="chartContainer" class="col-md-6"> Chargement des données ...</div>
            <div id="stackedShartContainer" class="col-md-6">Chargement des données ...</div>


            
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection

@section('fc')
<script type="text/javascript">
  
  FusionCharts.ready(function(){
      var revenueChart = new FusionCharts({
        "type": "column2d",
        "renderAt": "chartContainer",
        "width": "100%",
        "height": "500",
        
        "dataSource": "<?php echo url() ?>/admin/jsonChart",
        "dataFormat": "jsonurl"   

       
    });
var quizStackedChart = new FusionCharts({
        "type": "stackedcolumn2d",
        "renderAt": "stackedShartContainer",
        "width": "100%",
        "height": "500",        
        "dataSource": "<?php echo url() ?>/admin/statcked",
        "dataFormat": "jsonurl"   

       
    });

    revenueChart.render();
    quizStackedChart.render();
})

</script>
@endsection