@inject('pages', 'App\Services\Quiz\CourService')
<ul class="list-group" >
        @foreach ($pages->pageLists($cour->id) as $page)
            <li class="list-group-item  <?php echo Request::segment(4) == $page->slug ? 'active' : '' ?>" >{!! link_to( 'cour/'.$cour->slug.'/page/'.$page->slug, $page->title) !!}</li>
        @endforeach
</ul>  

