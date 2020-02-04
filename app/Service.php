<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $table = 'services';
    protected $primaryKey = 'id';
    public $incrementing = TRUE;

    public $timestamps = TRUE;
    protected $dates = ['deleted_at'];

    protected $fillable = ['title']; //разрешает поля к записи
    // protected $guarded = ['id']; //поля не доступные к записи

    public function searchReports(){
        return $this->hasMany('App\SearchReport', 'services_id');
    }

    public function promotion(){
        return $this->hasMany('App\Promotion', 'services_id');
    }

    public function price(){
        return $this->hasMany('App\Price', 'services_id');
    }


}
