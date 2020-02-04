<?php

namespace App\Repositories;
use App\Cosmetologie;
use App\Article;


class ReportsRepository extends Repository{


    protected $reports; // репозиторий ролей

    public function __construct(){
        $this->getReport1();
        $this->getReport2();
    }//__construct()


    public function takeReports(){
        return $this->reports;
    }

    public function getReport1(){
        $id = '1';
        $title = "Рейтинг косметологических салонов по количесту просмотров посетителей";
        $cells = ['id', 'title', 'views_numb'];
        $cellsTitle = ['ID', 'Название', 'Просмотров'];
        $data = Cosmetologie::select('id', 'title', 'views_numb')
             ->orderBy('views_numb', 'desc')
             ->take(20)
             ->paginate(5);

        $report1 = ['id' => $id, 'title' => $title, 'data' => $data, 'cells' => $cells, 'cellsTitle' => $cellsTitle];
        $this->reports = array_add($this->reports, 'report1', $report1);
    }//getReport1()


    public function getReport2(){
        $id = '2';
        $title = "Рейтинг статей по количеству просмотров посетителей";
        $cells = ['id', 'title', 'views_numb'];
        $cellsTitle = ['ID', 'Название', 'Просмотров'];
        $data = Article::select('id', 'title', 'views_numb')
            ->orderBy('views_numb', 'desc')
            ->take(20)
            ->paginate(5);

        $report2 = ['id' => $id, 'title' => $title, 'data' => $data, 'cells' => $cells, 'cellsTitle' => $cellsTitle];
        $this->reports = array_add($this->reports, 'report2', $report2);
    }//getReport2()

}
