<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Channel;

class Discussion extends Model
{
    protected $fillable=['title','description','channel_id','user_id'];



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

    protected $hidden = [
        'updated_at','slug'
    ];
}
