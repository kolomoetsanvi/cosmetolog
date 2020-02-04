<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cosmetologie;
use App\City;
use App\District;
use App\Personnel;
use App\Service;
use App\CosmetologiesPersonnel;

use App\Http\Requests\CosmetologRequest;
use App\Repositories\CosmetologiesRepository;
use Illuminate\Support\Facades\Storage;

use Auth;
use Gate;
use Image;
use Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class CosmetologiesController extends AdminController
{
    protected $maxPersonnel = 30; // максимальное кол-во фото персонала
    protected $maxWorks = 20;     // макс кол-во фото работ
    protected $maxInteriors = 9;     // макс кол-во фото интерьера

    //"инъекция" класса репозитория - для работы с базой данных
    public function __construct(CosmetologiesRepository $c_rep)
    {
        parent::__construct();
        $this->c_rep = $c_rep;
        $this->template = 'admin.cosmetologies';
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
        $this->title = "Редактор косметологов";
        //загружаем косметологии
        $cosmetologies = $this->c_rep->get('*', FALSE, 3);


        $this->content = view('admin.cosmetologies_content')->with('cosmetologies', $cosmetologies)->render();
        return $this->renderOutput();
    }//index()

    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======


    //создание косметологического салона
    public function create(){

        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/CosmetologPolicy
        if(Gate::denies('editCosmetolog', new \App\Cosmetologie())){
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $this->title = "Добавить косметологический салон";
        //подгружем необходимые данные для select-ов
        $cities = City::all();
        $districts = District::all();
        $personnel = Personnel::all();
        $services = Service::all();

        //т.к. создается новая запись, полей для добавления фото  = макс кол-ву
        $newPersonnelCount = $this->maxPersonnel;
        $newWorksCount = $this->maxWorks;
        $newInteriorsCount = $this->maxInteriors;

        $this->content = view('admin.cosmetologies_create_content')
            ->with(['img'=>FALSE,
                'imgLogo'=>FALSE,
                'cities'=>$cities,
                'districts'=>$districts,
                'personnel'=>$personnel,
                'services'=>$services,
                'strTitle' => $this->title,
                'newPersonnelCount' => $newPersonnelCount,
                'newWorksCount' => $newWorksCount,
                'newInteriorsCount' => $newInteriorsCount,
            ])
            ->render();
        return $this->renderOutput();
    }//create()


    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //сохранить новый косметологический салон
    public function store(CosmetologRequest $request){

        $result = $this->c_rep->addCosmetolog($request);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin/cosmetologies')->with($result);
    }//store()


    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //Редактирование пользователя
    public function edit($id){

        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/CosmetologPolicy
        if(Gate::denies('updateCosmetolog', new \App\Cosmetologie())){
            abort(403, 'Недостаточно прав для выполнения операции');
        }
        $this->user = Auth::user();
        $this->title = "Редактировать косметологический салон";


        //загружаем данные
        $cosmetolog = Cosmetologie::find($id);
        $cities = City::all();
        $districts = District::all();
        $personnel = Personnel::all();
        $services = Service::all();
        $cosmetolog->load('cosmetologiesPersonnel');
        $cosmetolog->load('price');

        // макс кол-во персонала - кол-во существующего персонала
        $newPersonnelCount = $this->maxPersonnel - $cosmetolog->cosmetologiesPersonnel()->count();

        // формируем массив с адресами файлов-фото работ комсметолога
        $works = Storage::disk('public')->files('assets/img/cosmetologies/'.$id.'/works');
        //формирует макс кол-во фото для добавления
        $newWorksCount = $this->maxWorks - count($works);

        // формируем массив с адресами файлов-фото интерьера
        $interiors = Storage::disk('public')->files('assets/img/cosmetologies/'.$id.'/interior');
        //формирует макс кол-во фото для добавления
        $newInteriorsCount = $this->maxInteriors - count($interiors);

        // проверяем есть ли основное фото
        $exists = Storage::disk('public')->exists('assets/img/cosmetologies/'.$id.'/main/main.jpg');

        // проверяем есть ли картинка логотипа
        $existsLogo = Storage::disk('public')->exists('assets/img/cosmetologies/'.$id.'/logo/logo.png');

        $this->content = view('admin.cosmetologies_create_content')
            ->with(['cosmetolog' => $cosmetolog,
                'img'=>$exists,
                'imgLogo'=>$existsLogo,
                'cities'=>$cities,
                'districts'=>$districts,
                'personnel'=>$personnel,
                'services'=>$services,
                'works'=>$works,
                'interiors'=>$interiors,
                'strTitle' => $this->title,
                'newPersonnelCount' => $newPersonnelCount,
                'newWorksCount' => $newWorksCount,
                'newInteriorsCount' => $newInteriorsCount,
                ])
            ->render();
        return $this->renderOutput();
    }//edit()

    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //сохранить изменения пользователя
    public function update(CosmetologRequest $request, $id){

        $result =  $this->c_rep->updateCosmetolog($request, $id);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin/cosmetologies')->with($result);
    }//update()



    //Удалить косметологический салон
    public function delete($id){

        $this->title = "Удаление косметологического салона";

        $result = $this->c_rep->deleteCosmetolog($id);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin/cosmetologies')->with($result);

    }//delete()


}
