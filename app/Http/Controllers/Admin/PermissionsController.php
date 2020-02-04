<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\PermissionsRepository;
use App\Repositories\RolesRepository;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


use Auth;
use Gate;
use Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;


class PermissionsController extends AdminController
{

    //"инъекция" классов репозиториев - для работы с базой данных
    public function __construct(PermissionsRepository $perm_rep, RolesRepository $role_rep)
    {
     parent::__construct();

        $this->perm_rep = $perm_rep;
        $this->role_rep = $role_rep;
        $this->template = 'admin.permissions';
    }//  public function __construct()

    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    public function index(){
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + User
        if(Gate::denies('EDIT_USERS')){
            abort(403, 'Недостаточно прав для выполнения операции');
        }
        $this->user = Auth::user();
        $this->title = "Менеджер прав пользователей";

        //загружаем данные
        $roles = $this->getRoles();
        $permissions = $this->getPermissions();

        $this->content = view('admin.permissions_content')->with(['roles' => $roles, 'permissions' => $permissions])->render();
        return $this->renderOutput();
    }// public function index()

    // промежуточные методы
    public function getRoles(){
        $roles = $this->role_rep->get();
        return $roles;
    }//getRoles()
    public function getPermissions(){
        $permissions = $this->perm_rep->get();
        return $permissions;
   }//getPermissions()



    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //сохранить изменение прав пользователей
    public function store(Request $request)
    {

        $result =$this->perm_rep->changePermissions($request);

        return back()->with($result);
    }//store


}
