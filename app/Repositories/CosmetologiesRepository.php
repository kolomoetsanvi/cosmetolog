<?php

namespace App\Repositories;

use App\Cosmetologie;
use App\City;
use App\District;
use App\Personnel;
use App\Service;
use App\CosmetologiesPersonnel;
use App\Price;

use Auth;
use Gate;
use Image;
use Config;

use App\Http\Requests\CosmetologRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class CosmetologiesRepository extends Repository{

    public function __construct(Cosmetologie $cosmetologie )
    {
        $this->model = $cosmetologie;
    }

//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==
//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==

    public function addCosmetolog(CosmetologRequest $request)
    {
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/CosmetologPolicy
        if(Gate::denies('editCosmetolog', $this->model)){
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $data = $request->all();

        $cities_id = $data['selectCities'];
        $districts_id = $data['selectDistricts'];

        $phone = isset( $data['phone']) ?  $data['phone'] : Null;
        $work_schedule = isset( $data['work_schedule']) ?  $data['work_schedule'] : Null;
        $site = isset( $data['site']) ?  $data['site'] : Null;
        $e_mail = isset( $data['e_mail']) ?  $data['e_mail'] : Null;
        $vk = isset( $data['vk']) ?  $data['vk'] : Null;
        $ok = isset( $data['ok']) ?  $data['ok'] : Null;
        $fb = isset( $data['fb']) ?  $data['fb'] : Null;
        $inst = isset( $data['inst']) ?  $data['inst'] : Null;

        $id = Cosmetologie::insertGetId([
            'title' => $data['title'],
            'cities_id' => $cities_id,
            'districts_id' => $districts_id,
            'address' => $data['address'],
            'phone' => $phone,
            'work_schedule' => $work_schedule,
            'site' => $site,
            'e_mail' => $e_mail,
            'brief' => $data['brief'],
            'vk' => $vk,
            'ok' => $ok,
            'fb' => $fb,
            'inst' => $inst,
            'maps' => $data['maps'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        if(!$id){return back()->with(['error' => 'ошибка записи']);}


        // проверяем загрузили фото или нет
        if($request->hasFile('imageMain')){
            $imageMain = $request->file('imageMain');
            //проверяем корректно ли было загрузено изображение на сервер
            if($imageMain->isValid()){

                $path = $request->file('imageMain')->storeAs(
                    'public/assets/img/cosmetologies/'.$id.'/main', 'main.jpg'
                );
                //устанавливаем доступ к файлу
                Storage::setVisibility($path, 'public');
                // обрезаем файл
                $img = Image::make(public_path('storage/assets/img/cosmetologies/'.$id.'/main/main.jpg'));
                $img->fit(640, 480, function ($constraint) {
                    $constraint->upsize();
                })->save();

            }//if($image->isValid())
        }// if




        // проверяем загрузили лого или нет
        if($request->hasFile('imageLogo')){
            $imageMain = $request->file('imageLogo');
            //проверяем корректно ли было загрузено изображение на сервер
            if($imageMain->isValid()){

                $path = $request->file('imageLogo')->storeAs(
                    'public/assets/img/cosmetologies/'.$id.'/logo', 'logo.jpg'
                );
                //устанавливаем доступ к файлу
                Storage::setVisibility($path, 'public');
                // обрезаем файл
                $img = Image::make(public_path('storage/assets/img/cosmetologies/'.$id.'/logo/logo.jpg'));
                $img->fit(90, 60, function ($constraint) {
                    $constraint->upsize();
                })->save();

            }//if($image->isValid())
        }// if(




        //Обработка персона================================
        $personal = collect($data['selectedPersonnel']);

        // убираем не выбранные ячейки (значение -1)
        $personal = $personal->filter(function ($value, $key) {
            return $value != -1;
        });
        $personal->all();
        // оставляем уникальные значения
        $personal = $personal->unique();
        $personal->values()->all();


        $cosmetolog = Cosmetologie::find($id);
        $cosmetolog->cosmetologiesPersonnel()->sync($personal);
        //================================Обработка персона



        //Обработка фото работ================================
        // проверяем загрузили фото или нет
        if($request->hasFile('imageWorks')){
            //преобразуем массив данных в коллекцию ларавель
            $imageWorks = collect($request->file('imageWorks'));
            // оставляем уникальные файлы
            $imageWorks = $imageWorks->unique();
            $imageWorks->values()->all();
           $i = 0;


            foreach ($imageWorks as $image){
                //проверяем корректно ли было загрузено изображение на сервер
                if($image->isValid()){
                    $imgName = str_random(6);
                    $path = $image->storeAs(
                        'public/assets/img/cosmetologies/'.$id.'/works', $imgName.'.jpg'
                    );
                    //устанавливаем доступ к файлу
                    Storage::setVisibility($path, 'public');
                    // обрезаем файл
                    $img = Image::make(public_path('storage/assets/img/cosmetologies/'.$id.'/works/'.$imgName.'.jpg'));
                    $img->fit(640, 480, function ($constraint) {
                        $constraint->upsize();
                    })->save();

                }//if($image->isValid())
                $i++;
            }//foreach
        }// if(
        //================================Обработка фото работ


        //Обработка фото Интерьера================================
        // проверяем загрузили фото или нет
        if($request->hasFile('imageInteriors')){
            //преобразуем массив данных в коллекцию ларавель
            $imageInteriors = collect($request->file('imageInteriors'));
            // оставляем уникальные файлы
            $imageInteriors = $imageInteriors->unique();
            $imageInteriors->values()->all();
            $i = 0;


            foreach ($imageInteriors as $image){
                //проверяем корректно ли было загрузено изображение на сервер
                if($image->isValid()){
                    $imgName = str_random(6);
                    $path = $image->storeAs(
                        'public/assets/img/cosmetologies/'.$id.'/interior', $imgName.'.jpg'
                    );
                    //устанавливаем доступ к файлу
                    Storage::setVisibility($path, 'public');
                    // обрезаем файл
                    $img = Image::make(public_path('storage/assets/img/cosmetologies/'.$id.'/interior/'.$imgName.'.jpg'));
                    $img->fit(640, 480, function ($constraint) {
                        $constraint->upsize();
                    })->save();

                }//if($image->isValid())
                $i++;
            }//foreach
        }// if(
        //================================Обработка фото интерьера


        //Обработка прайса================================
        if(!$request->has('serviceCheck')) {
            // Создаем пустой прайс
            $priceId = Price::insertGetId([
                'cosmetologies_id' => $id,
                'services_id' => 1000,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            if (!$priceId) {
                return back()->with(['error' => 'ошибка создания прайса']);
            }
        } else{
            $services = $data['serviceCheck'];
            $cosmetolog-> services()->sync($services);

            //введенные цены
            $prices = $data['servicePrice'];
            foreach($services as $service){
               Price::where('cosmetologies_id', $id)
                   ->where('services_id', $service)
                   ->update(['cost' => $prices[$service]]);
            }//foreach

        }//if(!$request->has('serviceCheck'))

        //================================Обработка прайса




        return ['status' => 'Косметологический салон добавлен'];
    }//   addPerson(PersonnelRequest $request)

//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==
//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==

    public function updateCosmetolog(CosmetologRequest $request, $id)
    {
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/CosmetologPolicy
        if(Gate::denies('updateCosmetolog', $this->model)){
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $data = $request->all();
        if(!isset($data)){
            return array('error' => 'Нет данных');
        }

        $cosmetolog = Cosmetologie::find($id);

        $cities_id = $data['selectCities'];
        $districts_id = $data['selectDistricts'];

        $phone = isset( $data['phone']) ?  $data['phone'] : Null;
        $work_schedule = isset( $data['work_schedule']) ?  $data['work_schedule'] : Null;
        $site = isset( $data['site']) ?  $data['site'] : Null;
        $e_mail = isset( $data['e_mail']) ?  $data['e_mail'] : Null;
        $vk = isset( $data['vk']) ?  $data['vk'] : Null;
        $ok = isset( $data['ok']) ?  $data['ok'] : Null;
        $fb = isset( $data['fb']) ?  $data['fb'] : Null;
        $inst = isset( $data['inst']) ?  $data['inst'] : Null;

        $cosmetolog->update([
            'title' => $data['title'],
            'cities_id' => $cities_id,
            'districts_id' => $districts_id,
            'address' => $data['address'],
            'phone' => $phone,
            'work_schedule' => $work_schedule,
            'site' => $site,
            'e_mail' => $e_mail,
            'brief' => $data['brief'],
            'vk' => $vk,
            'ok' => $ok,
            'fb' => $fb,
            'inst' => $inst,
            'maps' => $data['maps'],
        ]);
        if(!$cosmetolog){return back()->with(['error' => 'ошибка редактирования']);}


        // если установлен checkBox, то удаляем текущее фото
        if (isset($data['deleteCheck'])){
            Storage::disk('public')->deleteDirectory('assets/img/cosmetologies/'.$id.'/main');
        };

        // проверяем загрузили фото или нет
        if($request->hasFile('imageMain')){
            $imageMain = $request->file('imageMain');
            //проверяем корректно ли было загрузено изображение на сервер
            if($imageMain->isValid()){

                $path = $request->file('imageMain')->storeAs(
                    'public/assets/img/cosmetologies/'.$id.'/main', 'main.jpg'
                );
                //устанавливаем доступ к файлу
                Storage::setVisibility($path, 'public');
                // обрезаем файл
                $img = Image::make(public_path('storage/assets/img/cosmetologies/'.$id.'/main/main.jpg'));
                $img->fit(640, 480, function ($constraint) {
                    $constraint->upsize();
                })->save();

            }//if($image->isValid())
        }// if


        // если установлен checkBox, то удаляем текущее фото
        if (isset($data['deleteLogoCheck'])){
            Storage::disk('public')->deleteDirectory('assets/img/cosmetologies/'.$id.'/logo');
        };

        // проверяем загрузили лого или нет
        if($request->hasFile('imageLogo')){
            $imageMain = $request->file('imageLogo');
            //проверяем корректно ли было загрузено изображение на сервер
            if($imageMain->isValid()){

                $path = $request->file('imageLogo')->storeAs(
                    'public/assets/img/cosmetologies/'.$id.'/logo', 'logo.jpg'
                );
                //устанавливаем доступ к файлу
                Storage::setVisibility($path, 'public');
                // обрезаем файл
                $img = Image::make(public_path('storage/assets/img/cosmetologies/'.$id.'/logo/logo.jpg'));
                $img->fit(90, 60, function ($constraint) {
                    $constraint->upsize();
                })->save();

            }//if($image->isValid())
        }// if(









        //Обработка персона================================
        //преобразуем массив данных в коллекцию ларавель
        $personal = collect($data['selectedPersonnel']);

        // убираем не выбранные ячейки (значение -1)
        $personal = $personal->filter(function ($value, $key) {
            return $value != -1;
        });
        $personal->all();
        // оставляем уникальные значения
        $personal = $personal->unique();
        $personal->values()->all();


        $cosmetolog = Cosmetologie::find($id);
        $cosmetolog->cosmetologiesPersonnel()->sync($personal);
        //================================Обработка персона



        //Обработка фото работ================================
        //удаляем отмеченные фото
        if($request->has('worksCheckDelete')) {
            $worksDelete = $data['worksCheckDelete'];
            foreach ($worksDelete as $work) {
                Storage::disk('public')->delete($work);
            }//foreach
        } //ша

        // загружаем выбранные фото
        // проверяем загрузили фото или нет
        if($request->hasFile('imageWorks')){
            //преобразуем массив данных в коллекцию ларавель
            $imageWorks = collect($request->file('imageWorks'));
            // оставляем уникальные файлы
            $imageWorks = $imageWorks->unique();
            $imageWorks->values()->all();
            $i = 0;
            foreach ($imageWorks as $image){
                //проверяем корректно ли было загрузено изображение на сервер
                if($image->isValid()){
                    $imgName = str_random(6);
                    $path = $image->storeAs(
                        'public/assets/img/cosmetologies/'.$id.'/works', $imgName.'.jpg'
                    );
                    //устанавливаем доступ к файлу
                    Storage::setVisibility($path, 'public');
                    // обрезаем файл
                    $img = Image::make(public_path('storage/assets/img/cosmetologies/'.$id.'/works/'.$imgName.'.jpg'));
                    $img->fit(640, 480, function ($constraint) {
                        $constraint->upsize();
                    })->save();

                }//if($image->isValid())
                $i++;
            }//foreach
        }// if(
        //================================Обработка фото работ



        //Обработка фото интерьера================================
        //удаляем отмеченные фото
        if($request->has('interiorsCheckDelete')) {
            $interiorsDelete = $data['interiorsCheckDelete'];
            foreach ($interiorsDelete as $interiors) {
                Storage::disk('public')->delete($interiors);
            }//foreach
        } //ша

        // загружаем выбранные фото
        // проверяем загрузили фото или нет
        if($request->hasFile('imageInteriors')){
            //преобразуем массив данных в коллекцию ларавель
            $imageInteriors = collect($request->file('imageInteriors'));
            // оставляем уникальные файлы
            $imageInteriors = $imageInteriors->unique();
            $imageInteriors->values()->all();
            $i = 0;
            foreach ($imageInteriors as $image){
                //проверяем корректно ли было загрузено изображение на сервер
                if($image->isValid()){
                    $imgName = str_random(6);
                    $path = $image->storeAs(
                        'public/assets/img/cosmetologies/'.$id.'/interior', $imgName.'.jpg'
                    );
                    //устанавливаем доступ к файлу
                    Storage::setVisibility($path, 'public');
                    // обрезаем файл
                    $img = Image::make(public_path('storage/assets/img/cosmetologies/'.$id.'/interior/'.$imgName.'.jpg'));
                    $img->fit(640, 480, function ($constraint) {
                        $constraint->upsize();
                    })->save();

                }//if($image->isValid())
                $i++;
            }//foreach
        }// if(
        //================================Обработка фото интерьера




        //Обработка прайса================================
        if($request->has('serviceCheck')) {
            $services = $data['serviceCheck'];
            $cosmetolog-> services()->sync($services);

            //введенные цены
            $prices = $data['servicePrice'];
            foreach($services as $service){
                Price::where('cosmetologies_id', $id)
                    ->where('services_id', $service)
                    ->update(['cost' => $prices[$service]]);
            }//foreach

        }//if(!$request->has('serviceCheck'))

        //================================Обработка прайса


        return ['status' => 'Данные косметологического салона обновлены'];

    }//   updateCosmetolog(CosmetologRequest $request, $id)

//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==
//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==

    public function deleteCosmetolog( $id)
    {
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/CosmetologPolicy
        if (Gate::denies('deleteCosmetolog', $this->model)) {
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $cosmetolog = Cosmetologie::find($id);
        $cosmetolog->cosmetologiesPersonnel()->detach();
        $cosmetolog-> services()->detach();
        $cosmetolog->delete();
        if(!$cosmetolog){return back()->with(['error' => 'ошибка удаления']);}

        Storage::disk('public')->deleteDirectory('assets/img/cosmetologies/'.$id);

        return ['status' => 'Косметологический салон удален'];

    }//deletePerson( $id)



}

