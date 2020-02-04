<?php

namespace App\Repositories;
use App\Http\Requests\ServiceRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ServicesController;

use App\Service;
use Auth;
use Gate;
use Image;
use Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;


class ServiceRepository extends Repository{

    public function __construct(Service $service)
    {
        $this->model = $service;
    }



    public function addService (ServiceRequest $request)
    {
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/ServicePolicy
        if(Gate::denies('editService', $this->model)){
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $data = $request->all();

        $id = Service::insertGetId([
            'title' => $data['title'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        if(!$id){return back()->with(['error' => 'ошибка записи']);}

       return ['status' => 'Услуга добавлена'];

    }//  addService (ServiceRequest $request)

//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==
//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==

    public function updateService(ServiceRequest $request, $id)
    {
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/ServicePolicy
        if(Gate::denies('updateService', $this->model)){
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $data = $request->all();
        if(!isset($data)){
            return array('error' => 'Нет данных');
        }

        $service = Service::find($id);

        $service->update([
            'title' => $data['title'],
        ]);
        if(! $service){return back()->with(['error' => 'ошибка редактирования']);}

        return ['status' => 'Данные услуги обновлены'];

    }//   updateService(ServiceRequest $request, $id)

//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==
//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==

    public function deleteService( $id)
    {
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/Serviceolicy
        if (Gate::denies('deleteService', $this->model)) {
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $service = Service::find($id);
        $service->delete();
        if(!$service){return back()->with(['error' => 'ошибка удаления']);}

        return ['status' => 'Услуга удалена'];

    }//deleteService( $id)

}

