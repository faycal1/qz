<?php

namespace App\Http\Controllers\Backend\Access\User;

use Datatables;
use Carbon\Carbon ;
use App\Http\Controllers\Controller;
use App\Models\Departement\Departement;
use App\Repositories\Backend\User\UserContract;
use App\Repositories\Backend\Role\RoleRepositoryContract;
use App\Repositories\Frontend\Auth\AuthenticationContract;
use App\Http\Requests\Backend\Access\User\CreateUserRequest;
use App\Http\Requests\Backend\Access\User\StoreUserRequest;
use App\Http\Requests\Backend\Access\User\EditUserRequest;
use App\Http\Requests\Backend\Access\User\MarkUserRequest;
use App\Http\Requests\Backend\Access\User\UpdateUserRequest;
use App\Http\Requests\Backend\Access\User\DeleteUserRequest;
use App\Http\Requests\Backend\Access\User\RestoreUserRequest;
use App\Http\Requests\Backend\Access\User\ChangeUserPasswordRequest;
use App\Http\Requests\Backend\Access\User\UpdateUserPasswordRequest;
use App\Repositories\Backend\Permission\PermissionRepositoryContract;
use App\Http\Requests\Backend\Access\User\PermanentlyDeleteUserRequest;
use App\Http\Requests\Backend\Access\User\ResendConfirmationEmailRequest;

/**
 * Class UserController.
 */
class UserController extends Controller
{
  
    /**
     * @var UserContract
     */
    protected $users;

    /**
     * @var RoleRepositoryContract
     */
    protected $roles;

    /**
     * @var PermissionRepositoryContract
     */
    protected $permissions;

    /**
     * @param UserContract                 $users
     * @param RoleRepositoryContract       $roles
     * @param PermissionRepositoryContract $permissions
     */
    public function __construct(UserContract $users, RoleRepositoryContract $roles, PermissionRepositoryContract $permissions)
    {
        Carbon::setLocale('fr');
        $this->users = $users;
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    /**
     * @return mixed
     */
    public function index()
    {

        // echo 'hi';
        // foreach ($this->users->getAllUsers() as $user){
        // 	dd($user->action_buttons) ;
        // }

        // exit();
        return view('backend.access.index');
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return mixed
     */
    public function create(CreateUserRequest $request)
    {
        $departements = ['' => 'Choisissez un Département'] + Departement::lists('name', 'id')->all();

        return view('backend.access.create', compact('departements'))
            ->withRoles($this->roles->getAllRoles('sort', 'asc', true))
            ->withPermissions($this->permissions->getAllPermissions());
    }

    /**
     * @param StoreUserRequest $request
     *
     * @return mixed
     */
    public function store(StoreUserRequest $request)
    {
        $this->users->create(
            $request->except('assignees_roles', 'permission_user'),
            $request->only('assignees_roles'),
            $request->only('permission_user')
        );

        return redirect()->route('admin.access.users.index')->withFlashSuccess(trans('alerts.users.created'));
    }

    /**
     * @param $id
     * @param EditUserRequest $request
     *
     * @return mixed
     */
    public function edit($id, EditUserRequest $request)
    {
        $user = $this->users->findOrThrowException($id, true);
        $departements = ['' => 'Choisissez un Département'] +  Departement::lists('name', 'id')->all();

        return view('backend.access.edit', compact('departements'))
            ->withUser($user)
            ->withUserRoles($user->roles->lists('id')->all())
            ->withRoles($this->roles->getAllRoles('sort', 'asc', true))
            ->withUserPermissions($user->permissions->lists('id')->all())
            ->withPermissions($this->permissions->getAllPermissions());
    }

    /**
     * @param $id
     * @param UpdateUserRequest $request
     *
     * @return mixed
     */
    public function update($id, UpdateUserRequest $request)
    {
        $this->users->update($id,
            $request->except('assignees_roles', 'permission_user'),
            $request->only('assignees_roles'),
            $request->only('permission_user')
        );

        return redirect()->route('admin.access.users.index')->withFlashSuccess(trans('alerts.users.updated'));
    }

    /**
     * @param $id
     * @param DeleteUserRequest $request
     *
     * @return mixed
     */
    public function destroy($id, DeleteUserRequest $request)
    {
        $this->users->destroy($id);

        return redirect()->back()->withFlashSuccess(trans('alerts.users.deleted'));
    }

    /**
     * @param $id
     * @param PermanentlyDeleteUserRequest $request
     *
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteUserRequest $request)
    {
        $this->users->delete($id);

        return redirect()->back()->withFlashSuccess(trans('alerts.users.deleted_permanently'));
    }

    /**
     * @param $id
     * @param RestoreUserRequest $request
     *
     * @return mixed
     */
    public function restore($id, RestoreUserRequest $request)
    {
        $this->users->restore($id);

        return redirect()->back()->withFlashSuccess(trans('alerts.users.restored'));
    }

    /**
     * @param $id
     * @param $status
     * @param MarkUserRequest $request
     *
     * @return mixed
     */
    public function mark($id, $status, MarkUserRequest $request)
    {
        $this->users->mark($id, $status);

        return redirect()->back()->withFlashSuccess(trans('alerts.users.updated'));
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        return view('backend.access.deactivated')
            ->withUsers($this->users->getUsersPaginated(25, 0));
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        return view('backend.access.deleted')
            ->withUsers($this->users->getDeletedUsersPaginated(25));
    }

    /**
     * @return mixed
     */
    public function banned()
    {
        return view('backend.access.banned')
            ->withUsers($this->users->getUsersPaginated(25, 2));
    }

    /**
     * @param $id
     * @param ChangeUserPasswordRequest $request
     *
     * @return mixed
     */
    public function changePassword($id, ChangeUserPasswordRequest $request)
    {
        return view('backend.access.change-password')
            ->withUser($this->users->findOrThrowException($id));
    }

    /**
     * @param $id
     * @param UpdateUserPasswordRequest $request
     *
     * @return mixed
     */
    public function updatePassword($id, UpdateUserPasswordRequest $request)
    {
        $this->users->updatePassword($id, $request->all());

        return redirect()->route('admin.access.users.index')->withFlashSuccess(trans('alerts.users.updated_password'));
    }

    /**
     * @param $user_id
     * @param AuthenticationContract         $auth
     * @param ResendConfirmationEmailRequest $request
     *
     * @return mixed
     */
    public function resendConfirmationEmail($user_id, AuthenticationContract $auth, ResendConfirmationEmailRequest $request)
    {
        $auth->resendConfirmationEmail($user_id);

        return redirect()->back()->withFlashSuccess(trans('alerts.users.confirmation_email'));
    }

     public function userData()
    {
        $datatables = \App\Models\Access\User\User::select('*') ;

        return Datatables::of($datatables)
            ->addColumn('action', function ($users) {
                return $users->action_buttons;
            })           
            ->addColumn('role',function($users){

                  $roles ="" ;
                         if ($users->roles()->count() > 0){
                                 foreach ($users->roles as $role)
                                 {
                                      $roles .=$role->name .' ' ;
                                  }
                        }
                        else
                            'Pas de Role' ;
                        
                return $roles;
            })
            ->addColumn('quiz',function($users){
                return $users->cours->count();
            })
            ->addColumn('departement', function($users){     
                return $users->departement['name'] ;
            })
            ->editColumn('confirmed',  function ($users){
                return $users->confirmed == 1 ? 'Confirmé' : 'Non confirmé' ;
            })
            ->make(true);
    }
}
