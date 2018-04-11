<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable=['reply','discussion_id','user_id'];

    public function discussion()
    {
        return $this->belongsTo('App\Models\Discussion');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    protected $hidden=['updated_at'];
}
