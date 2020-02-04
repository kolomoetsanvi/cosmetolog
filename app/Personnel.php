<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personnel extends Model
{
    use SoftDeletes;

    protected $table = 'personnel';
    protected $primaryKey = 'id';
    public $incrementing = TRUE;

    public $timestamps = TRUE;
    protected $dates = ['deleted_at'];

    protected $fillable = ['surname', 'name', 'patronymic', 'created_at', 'updated_at']; //разрешает поля к записи
    // protected $guarded = ['id']; //поля не доступные к записи

    public function cosmetologiesPersonnel(){
        return $this->hasMany('App\CosmetologiesPersonnel', 'personnel_id');
    }
}
