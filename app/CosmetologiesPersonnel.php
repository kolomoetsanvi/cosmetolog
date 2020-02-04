<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CosmetologiesPersonnel extends Model
{
    use SoftDeletes;

    protected $table = 'cosmetologies_personnel';
    protected $primaryKey = 'id';
    public $incrementing = TRUE;

    public $timestamps = TRUE;
    protected $dates = ['deleted_at'];

    // protected $fillable = ['title']; //разрешает поля к записи
    // protected $guarded = ['id']; //поля не доступные к записи

    public function cosmetologie(){
        return $this->belongsTo('App\Cosmetologie', 'cosmetologies_id');
    }

    public function personnel(){
        return $this->belongsTo('App\Personnel', 'personnel_id');
    }

}
