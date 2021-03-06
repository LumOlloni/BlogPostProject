<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TextLimit;
use App\Traits\ImageService;


class Post extends Model
{

    use TextLimit, ImageService;

    protected $table = 'posts';
    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'title', 'body', 'slug' , 'user_id', 'image', 'order' ,'published' ,'category_id'
    ];

    public function category(){

        return $this->belongsTo('App\Category');
    }
    public function user(){

        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    protected static function boot()
    {     
        parent::boot();

        static::deleting(function ($post) {
            $post->comments()->delete();
        });

    }
}
