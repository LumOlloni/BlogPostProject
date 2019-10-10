<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    public $primaryKey = 'id';

    public $timestamps = true;
    protected $fillable = [ 'user_id', 'post_id' , 'body', 'published'];

    public function post()
    {
      return $this->belongsTo('App\Post');
    }
   
    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
