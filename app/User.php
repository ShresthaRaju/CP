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
        'name', 'email','username','password','verification_token','active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','verification_token','updated_at'
    ];

    protected $dispatchesEvents = [
        'created' => Events\NewUserRegistered::class,
    ];

    public function verified()
    {
        return $this->active===1;
    }

    public function discussions()
    {
        return $this->hasMany('App\Models\Discussion');
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Reply');
    }

    public function favorites()
    {
        return $this->hasMany('App\Models\Favorite');
    }

    /**
     * Scope a query to only include solved discussions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
