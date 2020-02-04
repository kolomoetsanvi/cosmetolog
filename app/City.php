<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    protected $table = 'cities';
    protected $primaryKey = 'id';
    public $incrementing = TRUE;

    public $timestamps = TRUE;
    protected $dates = ['deleted_at'];

    // protected $fillable = ['title']; //разрешает поля к записи
    // protected $guarded = ['id']; //поля не доступные к записи

    public function cosmetologie(){
        return $this->hasMany('App\Cosmetologie', 'cities_id');
    }

    public function searchReport(){
        return $this->hasMany('App\SearchReport', 'cities_id');
    }

    public function district(){
        return $this->belongsToMany('App\District','cities_districts', 'cities_id');
    }

}
