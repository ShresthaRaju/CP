<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }

    protected $hidden=['created_at','updated_at'];
}
