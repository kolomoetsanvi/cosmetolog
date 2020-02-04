<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\Paginator;




class ArticlesController extends Controller
{
    protected $paginateCount = 15;

    // загружаем все статьи с пагинацией
    public function execute(){

        $articles = Article::paginate($this->paginateCount);
        $data = array('articles'=>$articles,
            'title'=>'Список статей'
        );
        return View('pages.articles',$data);
    }//execute()



    public function articlesSearch(Request $request)
    {
        //загружаем аргумент поиска, введенный на главной странице
        $inArticlesSearch = $request->input('inArticlesSearch');

        //основной запрос
        $articles = Article::where('title', 'like', '%'.$inArticlesSearch.'%')->paginate($this->paginateCount);

        $data = array('articles'=>$articles,
            'title'=>'Список статей'
        );
        return View('pages.articles',$data);
    }//articlesSearch
}
