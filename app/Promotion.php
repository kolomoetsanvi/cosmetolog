<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use SoftDeletes;

    protected $table = 'promotions';
    protected $primaryKey = 'id';
    public $incrementing = TRUE;

    public $timestamps = TRUE;
    protected $dates = ['deleted_at'];

     protected $fillable = ['cosmetologies_id', 'services_id', 'start', 'end', 'new_cost']; //разрешает поля к записи
    // protected $guarded = ['id']; //поля не доступные к записи

    public function cosmetologie(){
        return $this->belongsTo('App\Cosmetologie', 'cosmetologies_id');
    }

    public function service(){
        return $this->belongsTo('App\Service', 'services_id');
    }


}
