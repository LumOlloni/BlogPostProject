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

   public  function limit_text($text, $limit) {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
      }
}
