@extends('frontend.layouts.master')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
                                                <div class="panel-heading"><i class="fa fa-home"></i> {{ trans('labels.cours_list') }}</div>
                                                <div class="panel-body">
                                                @foreach ($cours as $cour)
                                                    {{ dump($cour->pages) }}
                                                @endforeach
                                                </div>
                                            </div><!-- panel -->
		</div><!-- col-md-10 -->
	</div><!-- row -->
@endsection