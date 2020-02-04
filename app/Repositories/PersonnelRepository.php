<?php

namespace App\Repositories;
use App\Http\Requests\PersonnelRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\PersonnelController;

use App\Personnel;
use Auth;
use Gate;
use Image;
use Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;


class PersonnelRepository extends Repository{

    public function __construct(Personnel $personnel )
    {
        $this->model = $personnel;
    }



    public function addPerson(PersonnelRequest $request)
    {
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/ArticlePolicy
        if(Gate::denies('editPersonnel', $this->model)){
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $data = $request->all();

        $patronymic = isset( $data['patronymic']) ?  $data['patronymic'] : Null;
        $id = Personnel::insertGetId([
            'surname' => $data['surname'],
            'name' => $data['name'],
            'patronymic' => $patronymic,
        ]);


        if(!$id){return back()->with(['error' => 'ошибка записи']);}


        // проверяем загрузили фото или нет
        if($request->hasFile('image')){
            $image = $request->file('image');
            //проверяем корректно ли было загрузено изображение на сервер
            if($image->isValid()){

                $path = $request->file('image')->storeAs(
                    'public/assets/img/personnel/'.$id, 'personnel.jpg'
                );
                //устанавливаем доступ к файлу
                Storage::setVisibility($path, 'public');
                // обрезаем файл
                $img = Image::make(public_path('storage/assets/img/personnel/'.$id.'/personnel.jpg'));
                $img->fit(480, 640, function ($constraint) {
                    $constraint->upsize();
                })->save();

            }//if($image->isValid())
        }// if(

        return ['status' => 'Работник добавлен'];

    }//   addPerson(PersonnelRequest $request)

//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==
//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==

    public function updatePerson(PersonnelRequest $request, $id)
    {
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/ArticlePolicy
        if(Gate::denies('updatePersonnel', $this->model)){
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $data = $request->all();
        if(!isset($data)){
            return array('error' => 'Нет данных');
        }

        $person = Personnel::find($id);

        $patronymic = isset( $data['patronymic']) ?  $data['patronymic'] : Null;

        $person->update([
            'surname' => $data['surname'],
            'name' => $data['name'],
            'patronymic' => $patronymic,
        ]);
        if(!$person){return back()->with(['error' => 'ошибка редактирования']);}


        // если установлен checkBox, то удаляем текущее фото
        if (isset($data['deleteCheck'])){
            Storage::disk('public')->deleteDirectory('assets/img/personnel/'.$id);
        };

        // проверяем загрузили фото или нет
        if($request->hasFile('image')){
            $image = $request->file('image');
            //проверяем корректно ли было загрузено изображение на сервер
            if($image->isValid()){

                $path = $request->file('image')->storeAs(
                    'public/assets/img/personnel/'.$id, 'personnel.jpg'
                );
                //устанавливаем доступ к файлу
                Storage::setVisibility($path, 'public');
                // обрезаем файл
                $img = Image::make(public_path('storage/assets/img/personnel/'.$id.'/personnel.jpg'));
                $img->fit(480, 640, function ($constraint) {
                    $constraint->upsize();
                })->save();

            }//if($image->isValid())
        }// if

        return ['status' => 'Данные сотрудника обновлены'];

    }//   updatePerson(PersonnelRequest $request, $id)

//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==
//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==//==

    public function deletePerson( $id)
    {
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/PersonPolicy
        if (Gate::denies('deletePersonnel', $this->model)) {
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $person = Personnel::find($id);
        $person->delete();
        if(!$person){return back()->with(['error' => 'ошибка удаления']);}

        Storage::disk('public')->deleteDirectory('assets/img/personnel/'.$id);

        return ['status' => 'Сотрудник удален'];

    }//deletePerson( $id)

}

