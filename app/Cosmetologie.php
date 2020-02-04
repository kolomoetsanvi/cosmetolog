<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Price;
use Gate;

class Cosmetologie extends Model
{
    use SoftDeletes;

    protected $table = 'cosmetologies';
    protected $primaryKey = 'id';
    public $incrementing = TRUE;

    public $timestamps = TRUE;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',  'cities_id', 'districts_id', 'address',
        'phone', 'work_schedule', 'site', 'e_mail', 'brief',
        'vk', 'ok', 'fb', 'inst', 'maps'
    ]; //разрешает поля к записи
    // protected $guarded = ['id']; //поля не доступные к записи

    //=================================================================
    public function price(){
        return $this->hasMany('App\Price', 'cosmetologies_id');
    }

    public function services(){
        return $this->belongsToMany('App\Service', 'prices', 'cosmetologies_id', 'services_id');
    }

    public function promotion(){
        return $this->hasMany('App\Promotion', 'cosmetologies_id');
    }



    public function cosmetologiesPersonnel(){
        return $this->belongsToMany('App\Personnel', 'cosmetologies_personnel', 'cosmetologies_id');
//        return $this->hasMany('App\CosmetologiesPersonnel', 'cosmetologies_id');
    }

    public function districts(){
        return $this->belongsTo('App\District', 'districts_id');
    }

    public function cities(){
        return $this->belongsTo('App\City', 'cities_id');
    }

    public function cosmetologiesReport(){
        return $this->hasMany('App\CosmetologiesReport', 'cosmetologies_id');
    }


    public function articles(){
        return $this->hasMany('App\Article', 'cosmetologies_id ');
    }



    // Проверяет есть ли услуга с указанным id
    // в данном косметологическом салоне
    public function hasService($id){
        if(is_array($id)){
            foreach($id as $servId){
                $hasService = $this->hasService($servId);
                if($hasService){
                    return TRUE;
                }
                else if(!$hasService){
                    return FALSE;
                }
            }
            return FALSE;
        }
        else{
            foreach($this->services()->get() as $serv){
                if($serv->id == $id){
                    return TRUE;
                }
            }
        }
        return FALSE;
    }//public function hasService($id)


    public function getServiceCost($serviseId){
       $data =  Price::where('cosmetologies_id', $this->id)
                   ->where('services_id', $serviseId)
                    ->get('cost');
        foreach ($data as $item){
            return $item->cost;
        }

    }//getServiceCost


    public function dateCmp($date){
        $dateToday =  date('Y-m-d');
        if ($date >= $dateToday) return TRUE;
        else return FALSE ;
    }//dateCmp($date)

}
