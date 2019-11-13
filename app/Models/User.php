<?php

namespace App;



use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'role_id', 'password', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function post()
    {
        return $this->hasMany('App\Post');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public  function friends()
    {
        return $this->belongsToMany('App\User', 'friends_users', 'friend_id', 'user_id');
    }

    public function addFriend($id, $user_friend)
    {
        $this->friends()->sync([
            $id => [
                'friend_id' => $id,
                'user_id' => $user_friend,
                'request_id' => $id,
                'status' => 0
            ]
        ]);
    }

    public function removeFriend(User $user)
    {
        $this->friends()->detach($user->id);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->comments()->delete();
        });
    }
}
