    <div class="pull-right" style="margin-bottom:10px">
        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Categories <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{route('admin.quiz.category.index')}}">Toutes les Categories</a></li>

            @permission('create-categories')
                <li><a href="{{route('admin.quiz.category.create')}}">Créer une catégorie</a></li>
            @endauth

            {{--<li class="divider"></li>
             <li><a href="{{route('admin.access.users.deactivated')}}">{{ trans('menus.deactivated_users') }}</a></li>
            <li><a href="{{route('admin.access.users.banned')}}">{{ trans('menus.banned_users') }}</a></li>
            <li><a href="{{route('admin.access.users.deleted')}}">{{ trans('menus.deleted_users') }}</a></li> --}}
          </ul>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Cours <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{route('admin.quiz.category.cour.index')}}">Tous les cours</a></li>

            @permission('create-cours')
                <li><a href="{{route('admin.quiz.category.cour.create')}}">Créer un cours</a></li>
            @endauth
          </ul>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Pages <span class="caret"></span>
          </button>
          <ul class="dropdown-menu pull-right" role="menu">
            <li><a href="{{route('admin.quiz.category.cour.page.index')}}">Toutes les pages</a></li>
            @permission('create-page')
                <li><a href="{{route('admin.quiz.category.cour.page.create')}}">Créer une page</a></li>
            @endauth 
            
          </ul>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Questions <span class="caret"></span>
          </button>
          <ul class="dropdown-menu pull-right" role="menu">
            <li><a href="{{route('admin.quiz.category.cour.question.index')}}">Toutes les Questions</a></li>
            @permission('create-page')
                <li><a href="{{route('admin.quiz.category.cour.question.create')}}">Créer une Question</a></li>
            @endauth 
            
          </ul>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Reponses <span class="caret"></span>
          </button>
          <ul class="dropdown-menu pull-right" role="menu">
            <li><a href="{{route('admin.quiz.category.cour.question.answer.index')}}">Toutes les Reponses</a></li>
            @permission('create-page')
                <li><a href="{{route('admin.quiz.category.cour.question.answer.create')}}">Créer une reponse</a></li>
            @endauth 
            
          </ul>
        </div>

    </div>

    <div class="clearfix"></div>