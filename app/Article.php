<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $table = 'articles';
    protected $primaryKey = 'id';
    public $incrementing = TRUE;

    public $timestamps = TRUE;
    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'content', 'cosmetologies_id']; //разрешает поля к записи
   // protected $guarded = ['id']; //поля не доступные к записи

    public function articleReport(){
        return $this->hasMany('App\ArticleReport', 'articles_id');
    }

    public function cosmetologie(){
        return $this->belongsTo('App\Cosmetologie', 'cosmetologies_id');
    }

}
