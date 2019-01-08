<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body'];

    protected $dates = ['published_at'];

    protected $softDelete = true;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function scopeUnratedBy(Builder $query, User $user)
    {
        $query->whereDoesntHave('reviews', function (Builder $query) use ($user){
            $query->where('user_id', '=', $user->id);
        });
    }

    public function getRatingAttribute()
    {
        return round($this->reviews()->avg('rating'), 1);
    }
}
