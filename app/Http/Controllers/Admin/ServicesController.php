<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ServiceRepository;
use App\Http\Requests\ServiceRequest;
use Illuminate\Support\Facades\Storage;
use App\Service;

use Auth;
use Gate;
use Image;
use Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class ServicesController extends AdminController
{
    //"инъекция" класса репозитория - для работы с базой данных
    public function __construct(ServiceRepository $service_rep)
    {
        parent::__construct();
        $this->service_rep = $service_rep;

        $this->template = 'admin.services';
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
        $this->title = "Редактор услуг";
        //загружаем статьи
        $services =  $this->service_rep->get('*', FALSE, 10);


        $this->content = view('admin.services_content')->with('services', $services)->render();
        return $this->renderOutput();
    }//index()

    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //создание услуги
    public function create(){

        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/ServicePolicy
        if(Gate::denies('ADD_COSMETOLOGIES')){
            abort(403, 'Недостаточно прав для выполнения операции');
        }
        $this->title = "Добавить новую услугу";

        $this->content = view('admin.services_create_content')
            ->with(['strTitle' =>  $this->title])
            ->render();
        return $this->renderOutput();
    }//create()


    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //сохранить новую услугу
    public function store(ServiceRequest $request){

        $result = $this->service_rep->addService($request);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin/services')->with($result);
    }//store()


    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //Редактирование услугу
    public function edit($id){

        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/ServicePolicy
        if(Gate::denies('updateService', new \App\Service())){
            abort(403, 'Недостаточно прав для выполнения операции');
        }
        $this->user = Auth::user();
        $this->title = "Редактировать услугу";


        //загружаем данные
        $service = Service::find($id);

        $this->content = view('admin.services_create_content')
            ->with(['service' => $service,
                'strTitle' => $this->title])
            ->render();
        return $this->renderOutput();
    }//edit()

    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //сохранить изменения услуги
    public function update(ServiceRequest $request, $id){

        $result = $this->service_rep->updateService($request, $id);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin/services')->with($result);
    }//update()



    //Удалить услугу
    public function delete($id){

        $this->title = "Удаление услуги";

        $result = $this->service_rep->deleteService($id);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin/services')->with($result);

    }//delete()


}
