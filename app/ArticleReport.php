<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ArticleReport extends Model
{

    protected $table = 'article_reports';
    protected $primaryKey = 'id';
    public $incrementing = TRUE;

    public $timestamps = TRUE;

     protected $fillable = ['articles_id']; //разрешает поля к записи
    // protected $guarded = ['id']; //поля не доступные к записи

    public function article(){
        return $this->belongsTo('App\Article', 'articles_id');
    }
}
