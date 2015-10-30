@inject('cours', 'App\Services\Quiz\CourService')
<ul class="list-group" >
        @foreach ($cours->lists()as $cour)
            <li class="list-group-item <?php echo Request::segment(2) == $cour->slug ? 'active' : '' ?> " >{!! link_to( 'cour/'.$cour->slug, $cour->title) !!}</li>                             
        @endforeach
</ul>  

{{-- {!! $cours->lists()->render() !!} --}}