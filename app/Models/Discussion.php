<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Channel;

class Discussion extends Model
{
    protected $fillable=['title','description','channel_id','user_id'];

    protected $hidden = [
        'updated_at','slug'
    ];

    /**
     * Scope a query to only include solved discussions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSolved($query)
    {
        return $query->where('solved', 1);
    }

    /**
     * Scope a query to only include unsolved discussions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnsolved($query)
    {
        return $query->where('solved', 0);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // for injecting in _filters.blade.php
    public function filters()
    {
        $channels=Channel::all();
        return $channels;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
