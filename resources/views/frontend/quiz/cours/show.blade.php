@extends('frontend.layouts.master')

@section('content')
	<div class="row">
        <div class="col-md-2">
                <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> Liste des Cours</div>
                <div class="panel-body">
                    @include('frontend.includes.cours_list')
                </div>
            </div><!-- panel -->
        </div>           

		<div class="col-md-8">
			<div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> {{ $cour->title }} </div>
                <div class="panel-body">
                    <h2> {{ $cour->title }} </h2>
                    <p> {{ $cour->body }} </p>                    
                </div>
            </div><!-- panel -->
            @if(!is_null($page))
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-home"></i> {{ $page->title }} </div>
                    <div class="panel-body">
                        <h2> {{ $page->title }} </h2>
                        <p> {{ $page->body }} </p>                    
                    </div>
                </div><!-- panel -->
            @endif

         

		</div><!-- col-md-10 -->

        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> Liste des Pages </div>
                <div class="panel-body">
                    <ul class="list-group" >
                        @foreach ($cour->pages as $page)
                            <li class="list-group-item <?php echo Request::segment(3) == $page->slug ? 'active' : '' ?> " >
                                {!! link_to( 'cour/'.$cour->slug.'/'.$page->slug, $page->title) !!}
                            </li> 
                        @endforeach 
                    </ul>                 
                </div>
            </div><!-- panel -->

            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> Quiz </div>
                <div class="panel-body">
                    <ul class="list-group" >
                        @foreach ($cour->questions as $question)
                            <li class="list-group-item <?php echo Request::segment(4) == $question->slug ? 'active' : '' ?> " >
                                {!! link_to( 'cour/'.$cour->slug.'/'.$question->slug , $question->title) !!}

                                    {{-- <ul class="list-group" >
                                        @foreach ($question->answers as $answer)
                                            <li class="list-group-item  " >
                                               {{  $answer->body}}
                                            </li> 
                                        @endforeach 
                                    </ul>   --}}     

                            </li> 
                        @endforeach 
                    </ul>                 
                </div>
            </div><!-- panel -->

        </div><!-- col-md-10 -->

        

	</div><!-- row -->
@endsection