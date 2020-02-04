<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CosmetologiesReport extends Model
{
    protected $table = 'cosmetologies_reports';
    protected $primaryKey = 'id';
    public $incrementing = TRUE;

    public $timestamps = TRUE;

    protected $fillable = ['cosmetologies_id']; //разрешает поля к записи
    // protected $guarded = ['id']; //поля не доступные к записи

    public function cosmetologie(){
        return $this->belongsTo('App\Cosmetologie', 'cosmetologies_id');
    }


}
