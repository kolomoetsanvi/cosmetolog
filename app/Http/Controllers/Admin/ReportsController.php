<?php

namespace  App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Repositories\ReportsRepository;
use App\Repositories\CosmetologiesRepository;
use App\Repositories\ArticlesRepository;
use App\Repositories\Repository;
use App\Repositories\ViewsRepository;
use Illuminate\Http\Request;
use Auth;
use Gate;
use Config;

class ReportsController extends AdminController
{
    //"инъекция" классаов репозиториев - для работы с базой данных
    public function __construct( ReportsRepository $r_rep,
                                 CosmetologiesRepository $c_rep,
                                 ArticlesRepository $a_rep,
                                 ViewsRepository $view_rep
                                )
    {
        parent::__construct();

        $this->r_rep = $r_rep;
        $this->c_rep = $c_rep;
        $this->a_rep = $a_rep;
        $this->view_rep = $view_rep;
        $this->template = 'admin.reports';
    }//  public function __construct()

    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======

    public function index(){
        //Проверяем есть ли у пользователя соответствующие разрешения
        //AuthServiceProvider  + User
        if(Gate::denies('VIEW_REPORT')){
            abort(403, 'Недостаточно прав для выполнения операции');
        }
        $this->user = Auth::user();
        $this->title = "Отчеты";

        //загружаем количество просмотров сайта, косметологов , статей
        $viewsCount = $this->getCount('*', $this->view_rep);
        $cCount = $this->getCount('*', $this->c_rep);
        $cViewsCount = $this->getSum('views_numb', $this->c_rep);
        $aCount = $this->getCount('*', $this->a_rep);
        $aViewsCount = $this->getSum('views_numb', $this->a_rep);

        // получаем очеты
        $reports = $this->r_rep->takeReports();



        $this->content = view('admin.reports_content')
            ->with(['viewsCount' => $viewsCount,
                     'cCount' => $cCount,
                     'сViewsCount' => $cViewsCount,
                     'aCount' =>  $aCount,
                     'aViewsCount' =>  $aViewsCount,
                     'reports' =>  $reports,
            ])
            ->render();
        return $this->renderOutput();
    }//index()

    // промежуточные методы
    public function getCount(String $select, Repository $rep){
        $count = $rep->get($select)->count();
        return $count;
    }//getCount()

    public function getSum(String $select, Repository $rep){
        $count = $rep->get()->sum($select);
        return $count;
    }//getSum()


    //=======  //=======  //=======  //=======  //=======  //=======  //=======
    //=======  //=======  //=======  //=======  //=======  //=======  //=======
}
