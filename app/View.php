<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $table = 'views';
    protected $primaryKey = 'id';
    public $incrementing = TRUE;

    public $timestamps = TRUE;

    protected $fillable = ['created_at'];
}
