<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cosmetologie;
use App\CosmetologiesReport;
use App\CosmetologiesPersonnel;
use Illuminate\Support\Facades\Storage;
use Get;


class CosmetologController extends Controller
{
    public function execute($id){

        //записываем данные запроса в отчет
        CosmetologiesReport::create([
            'cosmetologies_id' => $id
        ]);

      //по id загружаем косметологический салон
      $cosmetologie = Cosmetologie::find($id);
      //увеличиваем счетчик просмотров
       $cosmetologie->increment('views_numb');

      // формируем массив с адресами файлов-фото интеръера
      $filesImgInterior = Storage::disk('public')->files('assets/img/cosmetologies/'.$id.'/interior');
      // формируем массив с адресами файлов-фото работ комсметолога
      $filesImgWorks = Storage::disk('public')->files('assets/img/cosmetologies/'.$id.'/works');


      $data = array('cosmetologie'=>$cosmetologie,
                    'filesImgInterior'=>$filesImgInterior,
                    'filesImgWorks'=>$filesImgWorks,
                    'title'=>'Косметолог'
                    );
      return View('pages.cosmetolog',$data);



    }//execute()
}
