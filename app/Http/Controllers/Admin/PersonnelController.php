<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PersonnelRepository;
use App\Http\Requests\PersonnelRequest;
use Illuminate\Support\Facades\Storage;
use App\Personnel;

use Auth;
use Gate;
use Image;
use Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class PersonnelController extends AdminController
{
    //"инъекция" класса репозитория - для работы с базой данных
    public function __construct(PersonnelRepository $person_rep)
    {
        parent::__construct();
        $this->person_rep = $person_rep;

        $this->template = 'admin.personnel';
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
        $this->title = "Редактор персонала";
        //загружаем статьи
        $personnel =  $this->person_rep->get('*', FALSE, 3);


        $this->content = view('admin.personnel_content')->with('personnel', $personnel)->render();
        return $this->renderOutput();
    }//index()

    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //создание работника
    public function create(){

        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + User
        if(Gate::denies('EDIT_USERS')){
            abort(403, 'Недостаточно прав для выполнения операции');
        }

        $this->title = "Добавить нового работника";

        $this->content = view('admin.personnel_create_content')
            ->with(['img'=>FALSE, 'strTitle' => $this->title])
            ->render();
        return $this->renderOutput();
    }//create()


    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //сохранить нового работника
    public function store(PersonnelRequest $request){

        $result = $this->person_rep->addPerson($request);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin/personnel')->with($result);
    }//store()


    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //Редактирование данных о работнике
    public function edit($id){

        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + Policy/PersonnelPolicy
        if(Gate::denies('updatePersonnel', new \App\Personnel())){
            abort(403, 'Недостаточно прав для выполнения операции');
        }
        $this->user = Auth::user();
        $this->title = "Редактировать сотрудника";


        //загружаем данные
        $person = Personnel::find($id);

        // проверяем есть ли фото
        $exists = Storage::disk('public')->exists('assets/img/personnel/'.$id.'/personnel.jpg');

        $this->content = view('admin.personnel_create_content')
            ->with(['person' => $person,
                     'img'=>$exists,
                     'strTitle' =>  $this->title])
            ->render();
        return $this->renderOutput();
    }//edit()

    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    //сохранить изменений данных о работнике
    public function update(PersonnelRequest $request, $id){

        $result = $this->person_rep->updatePerson($request, $id);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin/personnel')->with($result);
    }//update()



    //Удаление работника
    public function delete($id){

        $this->title = "Удаление работника";

        $result = $this->person_rep->deletePerson($id);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin/personnel')->with($result);

    }//delete()


}
