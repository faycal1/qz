@inject('quiz', 'App\Services\Quiz\CourService')
<?php $cour_user = $cour->hasUser(\Auth::user()->id, $cour->id) ?>
@if (count($cour_user) === 1)
    	{!! link_to( 'cour/'.$cour->slug.'/quiz/' , 'Jouer Au Quiz ?' , array('style' => 'color:#b52a2f !important; text-decoration: line-through;')) !!} <br>
    	Score <span style="color:#b52a2f; text-style:bold;" > {{$cour_user->score }} %</span>
@else
	{!! link_to( 'cour/'.$cour->slug.'/quiz/' , 'Jouer Au Quiz ?' ) !!}
@endif


    

