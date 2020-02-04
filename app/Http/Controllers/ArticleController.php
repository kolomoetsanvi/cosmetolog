<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\ArticleReport;
use Illuminate\Support\Facades\Storage;


class ArticleController extends Controller
{
    public function execute($id){

        //записываем данные запроса в отчет
        ArticleReport::create([
            'articles_id' => $id
        ]);

        //по id загружаем статью
        $article = Article::find($id);
        //увеличиваем счетчик просмотров
        $article->increment('views_numb');
        $data = array('article'=>$article,
            'title'=>'Статьи'
        );
        return View('pages.article',$data);







    }//execute()
}
