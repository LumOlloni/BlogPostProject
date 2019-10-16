<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $primaryKey = 'id';

    public $timestamps = true;

    public function post(){
        return $this->hasMany('App\Post');
    }

    protected static function boot()
    {     
        parent::boot();

        static::deleting(function ($category) {
            $category->post()->delete();
        });

    }
}
