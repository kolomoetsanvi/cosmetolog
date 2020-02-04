<?php

namespace App\Repositories;
use App\Repositories\RolesRepository;

use App\Permission;
use Gate;
use Illuminate\Http\Request;

class PermissionsRepository extends Repository{

    protected $role_rep; // репозиторий ролей

    public function __construct(Permission $permission, RolesRepository $role_rep )
    {
        $this->model = $permission;
        $this->role_rep = $role_rep;
    }


    public function changePermissions(Request $request){
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/ArticlePolicy
        if(Gate::denies('changePermissions',  $this->model)){
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $data = $request->except('_token');

        $roles = $this->role_rep->get();

        foreach ($roles as $value){
            if(isset($data[$value->id])){
                $value->savePermissions($data[$value->id]); //savePermissions - см. модель Role
            }
            else{
                $value->savePermissions([]);
            }
        }//foreach

        return ['status' => 'Права обновлены'];

    }//changePermissions($request)
}
