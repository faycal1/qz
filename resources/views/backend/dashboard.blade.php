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
          <h3 class="box-title">{{ trans('strings.backend.WELCOME') }} {!! auth()->user()->name !!}</h3>
          <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            
            <div class="col-md-6"> 
            <table class="table" >
                <thead>
                    <tr>
                        <th>Département </th>
                        <th>N° Employés </th>
                        <th>N° Quiz</th>
                        <th>Quiz Passés </th>
                        <th>Quiz Non Passés </th>
                        <th>N° Succées </th>
                        <th>N° Echec </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departements as $departement)
                        <tr>
                            <td>{{ $departement['dep'] }}</td>
                            <td>{{ $departement['users'] }}</td>
                            <td>{{ $departement['quiz'] }}</td>
                            <td>{{ $departement['nbr_passed'] }}</td>
                            <td>{{ $departement['nbr_non_passed'] }}</td>
                            <td>{{ $departement['succes'] }}</td>
                            <td>{{ $departement['failure'] }}</td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>            

            </div>
            <div id="stackedShartContainer" class="col-md-6">Chargement des données ...</div>


            
        </div><!-- /.box-body -->
        <div class="clearfix" ></div>
    </div><!--box box-success-->

    <div class="box box-success">
        <div class="box-header with-border">
          
          <div class="box-tools pull-right">
                 <select id="select_departement" name="select_departement"  >
                 </select> 
                 
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div><!-- /.box-header -->

        <div class="box-body" id="ContainerByCour">            
            
        </div><!-- /.box-body -->
            <div class="clearfix" ></div>
        </div><!--box box-success-->
@endsection

@section('fc')
<script type="text/javascript">
  
  FusionCharts.ready(function(){
    //   var revenueChart = new FusionCharts({
    //     "type": "column2d",
    //     "renderAt": "chartContainer",
    //     "width": "100%",
    //     "height": "500",
        
    //     "dataSource": "<?php echo url() ?>/admin/jsonChart",
    //     "dataFormat": "jsonurl"   

       
    // });
    //revenueChart.render();

    var quizStackedChart = new FusionCharts({
        "type": "stackedcolumn2d",
        "renderAt": "stackedShartContainer",
        "width": "100%",
        "height": "500",        
        "dataSource": "<?php echo url() ?>/admin/statcked",
        "dataFormat": "jsonurl" 
    });
    quizStackedChart.render();

    jQuery(document).ready(function($)
    {
        $eventSelect = jQuery('#select_departement').select2({
            width:'400',
            placeholder:'Quiz',
                ajax:{
                    url: "<?php echo url() ?>/cour/list",
                    dataType: 'json',
                    quietMillis: 100,
                    data: function (term, page) {
                        return {
                            term: term,    //search term
                            page_limit: 10 // page size
                        };
                    },
                    results: function (data, page) {
                        return { results: data.results };
                    }
                },
                initSelection: function(element, callback){
                    return $.getJSON("<?php echo url() ?>/cour/list" , null, function(data){
                            return callback(data);
                    });
                }          
        }); 

        $eventSelect.on("change", function (e) {            
           $.get('<?php echo url() ?>/admin/stats/cour/'+$(this).val() , function(data) {
                $('#ContainerByCour').html(data)
            });
        });       
    });    
})

</script>
@endsection