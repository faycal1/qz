    <div class="pull-right" style="margin-bottom:10px">
        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Département <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{route('admin.departement.index')}}">Tout les Département</a></li>

            @permission('create-category')
                <li><a href="{{route('admin.departement.create')}}">Créer un Département</a></li>
            @endauth

            <li class="divider"></li>
             <li><a href="{{route('admin.departement.deleted')}}">Département Supprimées</a></li>
           {{-- <li><a href="{{route('admin.access.users.banned')}}">{{ trans('menus.banned_users') }}</a></li>
            <li><a href="{{route('admin.access.users.deleted')}}">{{ trans('menus.deleted_users') }}</a></li> --}}
          </ul>
        </div>
    </div>

    <div class="clearfix"></div>