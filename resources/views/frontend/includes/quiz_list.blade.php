@inject('quiz', 'App\Services\Quiz\CourService')
<ul class="list-group" >
    @foreach ($quiz->questionsLists($cour->id) as $question)
        <li class="list-group-item <?php echo Request::segment(4) == $question->slug ? 'active' : '' ?> " >
            {!! link_to( 'cour/'.$cour->slug.'/quiz/'.$question->slug , $question->title) !!}
        </li> 
    @endforeach 
</ul>      

