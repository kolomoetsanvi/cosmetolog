<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

//Политики авторизации
//Используется для проверки
// есть ли у пользователя разрешения на соответствующие действия
//Подключается к определенной модели в AuthServiceProvider
//Использует фасад Gate
//Пример:
//if(Gate::denies('saveArticle', $this->model)){
//    abort(403);
//}
//saveArticle - метод данного класса
//$this->model к которой подключена данная проверка
class CosmetologPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function editCosmetolog(User $user){
        return $user->canDo('ADD_COSMETOLOGIES');
    }//saveArticle()

    public function updateCosmetolog(User $user){
        return $user->canDo('UPDATE_COSMETOLOGIES');
    }//updateArticle()

    public function deleteCosmetolog(User $user){
        return $user->canDo('DELETE_COSMETOLOGIES');
    }//updateArticle()
}
