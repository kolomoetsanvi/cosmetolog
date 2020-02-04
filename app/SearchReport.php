<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchReport extends Model
{
    protected $table = 'search_reports';
    protected $primaryKey = 'id';
    public $incrementing = TRUE;

    public $timestamps = TRUE;

    protected $fillable = ['cities_id', 'districts_id', 'services_id']; //разрешает поля к записи
    // protected $guarded = ['id']; //поля не доступные к записи

    public function districts(){
        return $this->belongsTo('App\District', 'districts_id');
    }

    public function cities(){
        return $this->belongsTo('App\City', 'cities_id');
    }

    public function servises(){
        return $this->belongsTo('App\Service ', 'services_id');
    }

}
