<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PromotionRepository;
use App\Http\Requests\PromotionRequest;
use Illuminate\Support\Facades\Storage;
use App\Promotion;
use App\Cosmetologie;
use App\Service;

use Auth;
use Gate;
use Image;
use Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class PromotionController extends AdminController
{
    //"инъекция" класса репозитория - для работы с базой данных
    public function __construct(PromotionRepository $promo_rep)
    {
        parent::__construct();
        $this->promo_rep = $promo_rep;

        $this->template = 'admin.promotions';
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
        $this->title = "Редактор акций";
        //загружаем акции
        $promotions =  $this->promo_rep->get('*', FALSE, 5);


        $this->content = view('admin.promotions_content')->with('promotions', $promotions)->render();
        return $this->renderOutput();
    }//index()

    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //создание Акционного предложения
    public function create(){

        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/PromotionPolicy
        if(Gate::denies('ADD_COSMETOLOGIES')){
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $this->title = "Добавить новую акцию";
        //Добавляем список косметологов и сервисов
        $cosmetologies = Cosmetologie::all(['id', 'title']);
        $services = Service::all(['id', 'title']);


        $this->content = view('admin.promotions_create_content')
            ->with(['cosmetologies'=>$cosmetologies,
                'services'=>$services,
                'img'=>FALSE,
                'strTitle' => $this->title])
            ->render();
        return $this->renderOutput();
    }//create()


    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //сохранить новую акцию
    public function store(PromotionRequest $request){

        $result = $this->promo_rep->addPromotion($request);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin/promotion')->with($result);
    }//store()


    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //Редактирование акций
    public function edit($id){

        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/PromotionPolicy
        if(Gate::denies('UPDATE_COSMETOLOGIES')){
            abort(403, 'Недостаточно прав для выполнения операции');
        }
        $this->user = Auth::user();
        $this->title = "Редактировать акцию";


        //загружаем данные
        $promotion = Promotion::find($id);
        //Добавляем список косметологов и сервисов
        $cosmetologies = Cosmetologie::all(['id', 'title']);
        $services = Service::all(['id', 'title']);

        // проверяем есть ли фото
        $exists = Storage::disk('public')->exists('assets/img/promotion/'.$id.'.jpg');

        $this->content = view('admin.promotions_create_content')
            ->with(['promotion' => $promotion,
                'cosmetologies'=>$cosmetologies,
                'services'=>$services,
                'img'=>$exists,
                'strTitle' => $this->title])
            ->render();
        return $this->renderOutput();
    }//edit()

    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //сохранить изменения акции
    public function update(PromotionRequest $request, $id){

        $result = $this->promo_rep->updatePromotion($request, $id);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin/promotion')->with($result);
    }//update()



    //Удаление акции
    public function delete($id){

        $this->title = "Удаление акции";

        $result = $this->promo_rep->deletePromotion($id);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin/promotion')->with($result);

    }//delete()


    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //При выборе косметологии меняется список услуг
    public function changeCosmetologie(Request $request){

     $result = $this->promo_rep->changeCosmetologie($request);
     return $result;
    }//changeCosmetologie($id)


}
