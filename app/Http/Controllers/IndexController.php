<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\City;
use App\District;
use App\Service;
use App\Article;
use App\View;
use Gate;

class IndexController extends Controller
{
    protected $aCount = 10; // количество статей выводится на стартовую страницу в карусель

    public function execute(){

        //Увеличеваем счетчик количества просмотров
        View::create(['created_at' => date('Y-m-d H:i:s')]);
        //получаем данные для передачи в представление (элементы select)
        $cities = City::all();
        $districts = District::all();
        $cervices = Service::all();
        //   Получаем статьи для вывода на стартовую страницу (в карусель)
        // выбираем самые последние - по дате добавления
        // если ко-во в базе меньше заданного  - выводим столько сколько есть
       $articles = Article::latest()->take(Article::count()>$this->aCount? $this->aCount : Article::count())->get();
        $data = array(
            'cities'=>$cities,
            'districts'=>$districts,
            'cervices'=>$cervices,
            'articles'=>$articles,
            'title'=>'Главная'
            );
        return View('pages.index',$data);


    }//execute()
}
