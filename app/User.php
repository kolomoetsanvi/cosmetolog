<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles(){
        return $this->belongsToMany('App\Role','role_user', 'user_id');
    }

    // разрешение либо массив разрешений
    // $require = FALSE - любое из разрешений массива
    //TRUE - все разрешения
    public function canDo($permission, $require = FALSE ){
        if(is_array($permission)){
            foreach($permission as $permName){
                $permName =$this->canDo($permName);
                if($permName && !$require){
                    return TRUE;
                }
                else if(!$permName && $require){
                    return FALSE;
                }
            }
            return $require;
        }
        else{
           foreach($this->roles as $role){
              foreach($role->permissions as $perm){
                  if(str_is($permission, $perm->name)){
                         return TRUE;
                  }
              }
           }
        }

    }//public function canDo


//либо роль ввиде строки, либо массив ролей
    public function hasRole($name, $require = FALSE ){
        if(is_array($name)){
            foreach($name as $roleName){
                $hasRole = $this->hasRole($roleName);
                if($hasRole && !$require){
                    return TRUE;
                }
                else if(!$hasRole && $require){
                    return FALSE;
                }
            }
            return $require;
        }
        else{
            foreach($this->roles as $role){
//            foreach($this->roles()->get as $role){
                if($role->name == $name){
                    return TRUE;
                  }
            }
        }
        return FALSE;
    }//public function hasRole







}
