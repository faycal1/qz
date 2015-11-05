<?php $cour_user = $cour->hasUser(\Auth::user()->id, $cour->id) ?>
@if (isset($cour_user['result'] ['question']) )
		
	    	{!! link_to( 'cour/'.$cour->slug.'/quiz/' , 'Jouer Au Quiz ?' , array('style' => 'color:#b52a2f !important; text-decoration: line-through;')) !!} <br>
	    	Score <span style="color:#b52a2f; text-style:bold;" > {{ $cour_user['score']}} %</span><br>	    	
	    	repondu à   <span style="color:#b52a2f; text-style:bold;" > {{ count( $cour_user['result'] ['question'])  }} </span>
	    	 Sur <span style="color:#b52a2f; text-style:bold;" > {{ $cour_user['questions']   }} </span><br>    	 
	    	resultats  	    	
	    	<ul>
		@foreach ($cour_user['result']['question'] as $key =>$answer)
			<li>
		    		<span style="color:#b52a2f; text-style:bold;" > Question {{  $key }} - {{ $answer['passed'] =='true' ?  'Juste' : 'Faux' }} </span>
		    	</li>
	    	@endforeach
		</ul>
@else
	{!! link_to( 'cour/'.$cour->slug.'/quiz/' , 'Jouer Au Quiz ?' ) !!}
@endif