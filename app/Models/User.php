<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $softDelete = true;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function findReview($post_id)
    {
        return $this->reviews
            ->where('post_id', $post_id)
            ->first();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
