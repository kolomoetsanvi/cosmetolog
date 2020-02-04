<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Gate;


class IndexController extends AdminController
{
    public function __construct()
    {

//        parent::__construct();
        $this->template = 'admin.index';
        $this->title = "Панель администратора";
    }//  public function __construct()

    public function index(){
        $this->user = Auth::user();

        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + User
        if(Gate::denies('VIEW_ADMIN')){
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        return $this->renderOutput();



    }//index()

}
