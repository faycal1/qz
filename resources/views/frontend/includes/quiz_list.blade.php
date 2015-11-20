<?php $cour_user = $cour->hasUser(\Auth::user()->id, $cour->id) ?>

<?php // var_dump(\Auth::user()->id  , $cour->id , $cour_user ) ?>

@if (isset($cour_user['result']['question']) )

			<?php  $color = $cour_user['score'] >='80' ?  'green' : 'red' ?>

	    	{!! link_to( 'cour/'.$cour->slug.'/quiz/' , 'Jouer Au Quiz ?' , 

	    	array('style' => "color:$color; text-decoration: line-through;")) !!} 

	    	<br>
	    	Score <span style="color:#b52a2f; text-style:bold;" > {{ $cour_user['score']}} %</span><br>	    	
	    	Repondu à   <span style="color:#b52a2f; text-style:bold;" > {{ count( $cour_user['result'] ['question'])  }} </span>
	    	 Sur <span style="color:#b52a2f; text-style:bold;" > {{ $cour_user['questions']   }} </span><br>    	 
	    	<hr> 
	    		    	
	    	<ul class="list-group" >
	    	<?php $i=1 ?>
		    @foreach ($cour_user['result']['question'] as $key =>$answer)
				<li  class="list-group-item  " >
			    	<span  class=" label label-{{ $answer =='true' ?  'success' : 'danger' }}" > Question {{  $i }} - {{ $answer =='true' ?  'Juste' : 'Faux' }} </span>
			    </li>
			  <?php $i++ ?>
	    	@endforeach

		</ul>
@else
	{!! link_to( 'cour/'.$cour->slug.'/quiz/' , 'Jouer Au Quiz ?' ) !!}
@endif