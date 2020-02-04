<?php

namespace App\Repositories;
use App\Http\Requests\PromotionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\PromotionController;

use App\Promotion;
use App\Cosmetologie;
use App\Service;
use Auth;
use Gate;
use Image;
use Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;


class PromotionRepository extends Repository{

    public function __construct(Promotion $promotion )
    {
        $this->model = $promotion;
    }



    public function addPromotion(PromotionRequest $request)
    {
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/PromotionPolicy
        if(Gate::denies('editPromotion', $this->model)){
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $data = $request->all();


        $id = Promotion::insertGetId([
            'cosmetologies_id' => $data['selectCosmetolog'],
            'services_id' => $data['selectService'],
            'start' => $data['start'],
            'end' => $data['end'],
            'new_cost' => $data['new_cost'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        if(!$id){return back()->with(['error' => 'ошибка записи']);}


        // проверяем загрузили фото или нет
        if($request->hasFile('image')){
            $image = $request->file('image');
            //проверяем корректно ли было загрузено изображение на сервер
            if($image->isValid()){

                $path = $request->file('image')->storeAs(
                    'public/assets/img/promotion/', $id.'.jpg'
                );
                //устанавливаем доступ к файлу
                Storage::setVisibility($path, 'public');
                // обрезаем файл
                $img = Image::make(public_path('storage/assets/img/promotion/'.$id.'.jpg'));
                $img->resize(480, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save();

            }//if($image->isValid())
        }// if(

        return ['status' => 'Акция добавлена'];

    }//  addPromotion(PromotionRequest $request)

//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==
//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==

    public function updatePromotion(PromotionRequest $request, $id)
    {
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/PromotionPolicy
        if(Gate::denies('updatePromotion', $this->model)){
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $data = $request->all();
        if(!isset($data)){
            return array('error' => 'Нет данных');
        }

        $promotion = Promotion::find($id);

        $promotion->update([
            'cosmetologies_id' => $data['selectCosmetolog'],
            'services_id' => $data['selectService'],
            'start' => $data['start'],
            'end' => $data['end'],
            'new_cost' => $data['new_cost'],
        ]);
        if(!$promotion){return back()->with(['error' => 'ошибка редактирования']);}


        // если установлен checkBox, то удаляем текущее изображение
        if (isset($data['deleteCheck'])){
            Storage::disk('public')->delete('assets/img/promotion/'.$id.'.jpg');
        };

        // проверяем загрузили фото или нет
        if($request->hasFile('image')){
            $image = $request->file('image');
            //проверяем корректно ли было загрузено изображение на сервер
            if($image->isValid()){

                $path = $request->file('image')->storeAs(
                    'public/assets/img/promotion/', $id.'.jpg'
                );
                //устанавливаем доступ к файлу
                Storage::setVisibility($path, 'public');
                // обрезаем файл
                $img = Image::make(public_path('storage/assets/img/promotion/'.$id.'.jpg'));
                $img->resize(480, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save();

            }//if($image->isValid())
        }// if(

        return ['status' => 'Данные акции обновлены'];

    }//   updatePromotion(PromotionRequest $request, $id)

//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==
//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==

    public function deletePromotion($id)
    {
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/PromotionPolicy
        if (Gate::denies('deletePromotion', $this->model)) {
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $promotion = Promotion::find($id);
        $promotion->delete();
        if(!$promotion){return back()->with(['error' => 'ошибка удаления']);}

        Storage::disk('public')->delete('assets/img/promotion/'.$id.'.jpg');

        return ['status' => 'Акция удалена'];


    }//deletePromotion ($id)


//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==
//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==

    //При выборе косметологии меняется список услуг
    public function changeCosmetologie(Request $request)
    {
        $id = $request->input('id');
        $cosmetologie = Cosmetologie::find($id);
        $serviceId = $request->input('service');
        echo '<select class="form-control" id="selectService" name="selectService" size="1" >';
        foreach($cosmetologie->services as $service){

           if($service->id == $serviceId)
                echo '<option selected="selected" value="'.$service->id.'">'.$service->title.'</option>';
           else
                echo '<option value="'.$service->id.'">'.$service->title.'</option>';
        }
        echo '</select>';
        echo '</br></br>';

    }//changeCosmetologie($id)



}


