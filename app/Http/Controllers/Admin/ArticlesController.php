<?php

namespace App\Http\Controllers\Admin;

use App\Cosmetologie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Storage;


use Auth;
use Gate;
use Image;
use Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
class ArticlesController extends AdminController
{

    public function __construct()
    {
//      parent::__construct();

        $this->template = 'admin.articles';
    }//  public function __construct()

    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    public function index(){
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + User
        if(Gate::denies('VIEW_ADMIN')){
            abort(403, 'Недостаточно прав для выполнения операции');
        }
        $this->user = Auth::user();
        $this->title = "Редактор статей";
        //загружаем статьи
        $articles = Article::paginate(3);


        $this->content = view('admin.articles_content')->with('articles', $articles)->render();
        return $this->renderOutput();
    }//index()

     //=======  //=======  //=======  //=======  //=======  //=======  //=======
     //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //создание статьи
    public function create(){

        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/ArticlePolicy
        if(Gate::denies('saveArticle', new \App\Article())){
            abort(403, 'Недостаточно прав для выполнения операции');
        }
        $this->user = Auth::user();
        $this->title = "Добавить новую статью";

        //Добавляем список косметологов
        $cosmetologies = Cosmetologie::all(['id', 'title']);
        $this->content = view('admin.articles_create_content')
                        ->with(['cosmetologies'=>$cosmetologies, 'img'=>FALSE, 'strTitle'=>$this->title])
                        ->render();
        return $this->renderOutput();
    }//create()



    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //сохранить новую статью
    public function store(ArticleRequest $request){

        //загружаем отправленные данные
        // заголовок, текст
        $data = $request->except('_token', 'image');
        if(!isset($data)){
            return array('error' => 'Нет данных');
        }
        // не обязательный параметр
       $cosmetologie_id = ($data['selectCosmetolog'] != -1) ? $data['selectCosmetolog'] : Null;

       $id = DB::table('articles')->insertGetId(
            [
                'title'=>$data['title'],
                'content'=>$data['content'],
                'cosmetologies_id'=>$cosmetologie_id,
                'created_at' => date('Y-m-d H:i:s')
         ]);

        if(!$id){return back()->with(['error' => 'ошибка записи']);}


        // проверяем загрузили фото или нет
        if($request->hasFile('image')){
            $image = $request->file('image');
            //проверяем корректно ли было загрузено изображение на сервер
            if($image->isValid()){

            $path = $request->file('image')->storeAs(
                  'public/assets/img/article/'.$id, 'main.jpg'
             );
            //устанавливаем доступ к файлу
                Storage::setVisibility($path, 'public');
            // обрезаем файл
                $img = Image::make(public_path('storage/assets/img/article/'.$id.'/main.jpg'));
                $img->fit(640, 480, function ($constraint) {
                    $constraint->upsize();
                })->save();

          }//if($image->isValid())
        }// if(


        return redirect('/admin/articles')->with(['status' => 'Материал добавлен']);
    }//store()


    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //Редактирование статьи
    public function edit($id){

        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/ArticlePolicy
        if(Gate::denies('updateArticle', new \App\Article())){
            abort(403, 'Недостаточно прав для выполнения операции');
        }
        $this->user = Auth::user();
        $this->title = "Редактировать статью";

        //по id загружаем статью
        $article = Article::find($id);

        // проверяем есть ли фото
        $exists = Storage::disk('public')->exists('assets/img/article/'.$id.'/main.jpg');

        //Добавляем список косметологов
        $cosmetologies = Cosmetologie::all(['id', 'title']);

        $this->content = view('admin.articles_create_content')
                        ->with(['article'=> $article, 'cosmetologies'=>$cosmetologies,
                                'img'=>$exists, 'strTitle'=>'Редактировать статью'])
                        ->render();
        return $this->renderOutput();
    }//edit()

    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //сохранить новую статью
    public function update(ArticleRequest $request, $id){

        //загружаем отправленные данные
        // заголовок, текст
        $data = $request->except('_token', 'image');

        if(!isset($data)){
            return array('error' => 'Нет данных');
        }
        //не обязательный параметр
        $cosmetologie_id = ($data['selectCosmetolog'] != -1) ? $data['selectCosmetolog'] : Null;

        $article = Article::find($id);
        $article->update(
            [
                'title'=>$data['title'],
                'content'=>$data['content'],
                'cosmetologies_id'=>$cosmetologie_id
            ]);


        if(!$article){return back()->with(['error' => 'ошибка редактирования']);}

        // если установлен checkBox, то удаляем текущее фото
        if (isset($data['deleteCheck'])){
            Storage::disk('public')->deleteDirectory('assets/img/article/'.$id);
        };

        // проверяем загрузили фото или нет
        if($request->hasFile('image')){
            $image = $request->file('image');
            //проверяем корректно ли было загрузено изображение на сервер
            if($image->isValid()){

                $path = $request->file('image')->storeAs(
                    'public/assets/img/article/'.$id, 'main.jpg'
                );
                //устанавливаем доступ к файлу
                Storage::setVisibility($path, 'public');
                // обрезаем файл
                $img = Image::make(public_path('storage/assets/img/article/'.$id.'/main.jpg'));
                $img->fit(640, 480, function ($constraint) {
                    $constraint->upsize();
                })->save();

            }//if($image->isValid())
        }// if(


        return redirect('/admin/articles')->with(['status' => 'Материал обновлен']);
    }//update()



    //Удаление статьи
    public function delete($id){

        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/ArticlePolicy
        if(Gate::denies('deleteArticle', new \App\Article())){
            abort(403, 'Недостаточно прав для выполнения операции');
        }
        $this->user = Auth::user();
        $this->title = "Удалиить статью";

        //по id загружаем статью
        $article = Article::find($id);


        $article->delete();
        if(!$article){return back()->with(['error' => 'ошибка удаление']);}
        // при удалении статьи удаляем изображения к статье
       Storage::disk('public')->deleteDirectory('assets/img/article/'.$id);

        return redirect('/admin/articles')->with(['status' => 'Материал удален']);

    }//delete()

}
