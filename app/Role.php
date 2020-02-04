<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users(){
        return $this->belongsToMany('App\User','role_user', 'role_id');
    }

    public function permissions(){
        return $this->belongsToMany('App\Permission','permission_role', 'role_id');
    }

//  $require - указывает метод вернет истину если роль имеет все права или хотябы одно
    public function hasPermission($name, $require = FALSE ){
        if(is_array($name)){
            foreach($name as $permissionName){
                $hasPermission = $this->hasPermission($permissionName);
                if($hasPermission && !$require){
                    return TRUE;
                }
                else if(!$hasPermission && $require){
                    return FALSE;
                }
            }
            return $require;
        }
        else{
            foreach($this->permissions()->get() as $permissions){
                if($permissions->name == $name){
                    return TRUE;
                }
            }
        }
        return FALSE;
    }//public function hasPermission ()


    public function savePermissions($inputPermissions){
            if(!empty($inputPermissions)){
                $this->permissions()->sync($inputPermissions);
            }
            else{
                $this->permissions()->detach();
            }
//        sync() Синхронизация связанных моделей через связующую таблицу по списку идентефикаторам
//        detach() отвязка всех записей
        return TRUE;
    }//savePermissions()
}
