<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $table = 'posts';
    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'title', 'body', 'slug' , 'user_id', 'image' ,'published' ,'category_id'
    ];

   
}
