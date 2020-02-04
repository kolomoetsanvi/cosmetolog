<?php

namespace App\Http\Controllers;

use App\City;
use App\Cosmetologie;
use App\SearchReport;
use App\District;
use App\Service;
use Illuminate\Http\Request;

class CosmetologiesController extends Controller
{
    protected $paginateCount = 5;

    public function execute(Request $request){

        //загружаем параметры поиска, выбранный на главной странице
        $citiId = $request->input('citiSelect', '0');
        $districtId = $request->input('districtSelect', '0');
        $serviceId =$request->input('serviceSelect', '0');

        //записываем данные запроса в отчет
        SearchReport::create([
            'cities_id' => $citiId == '0'? NULL: $citiId,
            'districts_id' => $districtId == '0'? NULL: $districtId,
            'services_id' => $serviceId == '0'? NULL: $serviceId
            ]);


        // если выбрано значение "Все" заменяем данные %
        if ($citiId == '0') $citiId = '%';
        if ($districtId == '0') $districtId = '%';
        if ($serviceId == '0') $serviceId = '%';

        //основной запрос
        $cosmetologies = Cosmetologie::where('cities_id', 'like', $citiId )
            ->where('districts_id', 'like', $districtId )
            //связанная таблица
            ->whereHas('price', function ($query) use ($serviceId){
                $query->where('services_id', 'like', $serviceId);
            })->paginate($this->paginateCount)
        ;

        $data = array(
            'cosmetologies'=>$cosmetologies,
            'title'=>'Список косметологов'
        );
        return View('pages.cosmetologies',$data);

    }//execute()
}
