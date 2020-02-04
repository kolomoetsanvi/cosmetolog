<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use SoftDeletes;

    protected $table = 'districts';
    protected $primaryKey = 'id';
    public $incrementing = TRUE;

    public $timestamps = TRUE;
    protected $dates = ['deleted_at'];

    // protected $fillable = ['title']; //разрешает поля к записи
    // protected $guarded = ['id']; //поля не доступные к записи


    public function cosmetologie(){
        return $this->hasMany('App\Cosmetologie', 'districts_id');
    }

    public function searchReport(){
        return $this->hasMany('App\SearchReport', 'districts_id');
    }

    public function cities(){
        return $this->belongsToMany('App\City','cities_districts', 'districts_id');
    }
}
