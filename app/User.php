<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
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
     * The movies that the user wants to watch.
     */
    public function movies()
    {
        return $this->belongsToMany('App\Movie', 'user_movie', 'user_id', 'movie_id')
            ->withPivot('has_watched')
            ->orderBy('has_watched')
            ->orderBy('title')
            ->withTimestamps();
    }
}
