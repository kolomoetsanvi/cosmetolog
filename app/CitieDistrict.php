<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CitieDistrict extends Model
{
    use SoftDeletes;

    protected $table = 'cities_districts';
    protected $primaryKey = 'id';
    public $incrementing = TRUE;

    public $timestamps = TRUE;
    protected $dates = ['deleted_at'];

    // protected $fillable = ['title']; //разрешает поля к записи
    // protected $guarded = ['id']; //поля не доступные к записи

//    public function districts(){
//        return $this->belongsToMany('App\District');
//    }
//
//    public function cities(){
//        return $this->belongsToMany('App\City');
//    }

}
