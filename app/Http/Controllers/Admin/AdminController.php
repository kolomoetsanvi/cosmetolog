<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Gate;

// родительский класс
class AdminController extends Controller
{
    protected $c_rep; // репозиторий косметологов
    protected $a_rep; // репозиторий статей
    protected $perm_rep; // репозиторий привелегей
    protected $role_rep; // репозиторий ролей
    protected $user_rep; // репозиторий пользователей
    protected $view_rep; // репозиторий просмотров
    protected $r_rep; // репозиторий отчетов
    protected $person_rep; // репозиторий персонала
    protected $promo_rep; // репозиторий акций
    protected $service_rep; // репозиторий услуг

    protected $user;   // данные зарегистрированного пользователя
    protected $template;   // шаблон
    protected $content = FALSE; //отрендеренный контент
    protected $title;  // заголовок

    protected $vars; // массив параметров


    public function __construct()
    {
    }//  public function __construct()


    public function  renderOutput(){

        $this->vars = array_add($this->vars, 'title', $this->title);

        if($this->content){
            $this->vars = array_add($this->vars, 'content', $this->content);
        }
        return view($this->template)->with($this->vars);
    }// public function  renderOutput(){




}
