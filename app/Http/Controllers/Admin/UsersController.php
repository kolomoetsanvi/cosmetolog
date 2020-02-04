<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\RolesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Storage;
use Auth;
use Gate;
use Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Repositories\UsersRepository;

class UsersController extends AdminController
{
    //"инъекция" классов репозиториев - для работы с базой данных
    public function __construct(UsersRepository $user_rep, RolesRepository $role_rep)
    {
      parent::__construct();

        $this->user_rep = $user_rep;
        $this->role_rep = $role_rep;
        $this->template = 'admin.users';
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
        $this->title = "Редактор пользователей";

        $users = $this->user_rep->get('*', FALSE, 3);

        $this->content = view('admin.users_content')->with(['users'=> $users])->render();
        return $this->renderOutput();
    }//index()

    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //создание пользователя
    public function create(){

        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/ArticlePolicy
        if(Gate::denies('editUser', new \App\User())){
            abort(403, 'Недостаточно прав для выполнения операции');
        }
        $this->user = Auth::user();
        $this->title = "Добавить нового пользователя";

        //загружаем данные
        $roles = $this->getRoles();

        $this->content = view('admin.users_create_content')
            ->with(['roles' => $roles, 'strTitle' => $this->title])
            ->render();
        return $this->renderOutput();
    }//create()

    // промежуточные методы
    public function getRoles(){
        $roles = $this->role_rep->get();
        return $roles;
    }//getRoles()


    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //сохранить нового пользователя
    public function store(UserRequest $request){

        $result = $this->user_rep->addUser($request);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin/users')->with($result);
    }//store()


    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //Редактирование пользователя
    public function edit($id){

        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/ArticlePolicy
        if(Gate::denies('editUser', new \App\User())){
            abort(403, 'Недостаточно прав для выполнения операции');
        }
        $this->user = Auth::user();
        $this->title = "Редактировать пользователя";


        //загружаем данные
        $user = User::find($id);
        $roles = $this->getRoles();

        $this->content = view('admin.users_create_content')
            ->with(['roles' => $roles, 'user' => $user, 'strTitle' => $this->title])
            ->render();
        return $this->renderOutput();
    }//edit()

    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //сохранить изменения пользователя
    public function update(UserRequest $request, $id){


        $result = $this->user_rep->updateUser($request, $id);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin/users')->with($result);
    }//update()



    //Удаление пользователя
    public function delete($id){

        $this->title = "Удаление пользователя";

        $result = $this->user_rep->deleteUser($id);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin/users')->with($result);

    }//delete()

}
