    <div class="pull-right" style="margin-bottom:10px">
        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Categories <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{route('admin.quiz.category.index')}}">Toutes les Categories</a></li>

            @permission('create-category')
                <li><a href="{{route('admin.quiz.category.create')}}">Créer une catégorie</a></li>
            @endauth

            <li class="divider"></li>
             <li><a href="{{route('admin.quiz.category.deleted')}}">Catégorie Supprimées</a></li>
           {{-- <li><a href="{{route('admin.access.users.banned')}}">{{ trans('menus.banned_users') }}</a></li>
            <li><a href="{{route('admin.access.users.deleted')}}">{{ trans('menus.deleted_users') }}</a></li> --}}
          </ul>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Cours <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{route('admin.quiz.cour.index')}}">Tous les cours</a></li>

            @permission('create-cours')
                <li><a href="{{route('admin.quiz.cour.create')}}">Créer un cours</a></li>
            @endauth

            <li class="divider"></li>
             <li><a href="{{route('admin.quiz.cour.deleted')}}">Cours Supprimées</a></li>
          </ul>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Pages <span class="caret"></span>
          </button>
          <ul class="dropdown-menu pull-right" role="menu">
            <li><a href="{{route('admin.quiz.page.index')}}">Toutes les pages</a></li>
            @permission('create-page')
                <li><a href="{{route('admin.quiz.page.create')}}">Créer une page</a></li>
            @endauth 

            <li class="divider"></li>
             <li><a href="{{route('admin.quiz.page.deleted')}}">Pages Supprimées</a></li>
            
          </ul>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Questions <span class="caret"></span>
          </button>
          <ul class="dropdown-menu pull-right" role="menu">
            <li><a href="{{route('admin.quiz.question.index')}}">Toutes les Questions</a></li>
            @permission('create-question')
                <li><a href="{{route('admin.quiz.question.create')}}">Créer une Question</a></li>
            @endauth 

            <li class="divider"></li>
             <li><a href="{{route('admin.quiz.question.deleted')}}">Questions Supprimées</a></li>
            
          </ul>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Reponses <span class="caret"></span>
          </button>
          <ul class="dropdown-menu pull-right" role="menu">
            <li><a href="{{route('admin.quiz.answer.index')}}">Toutes les Reponses</a></li>
            @permission('create-answer')
                <li><a href="{{route('admin.quiz.answer.create')}}">Créer une reponse</a></li>
            @endauth 

            <li class="divider"></li>
             <li><a href="{{route('admin.quiz.answer.deleted')}}">Reponses Supprimées</a></li>
            
          </ul>
        </div>

    </div>

    <div class="clearfix"></div>