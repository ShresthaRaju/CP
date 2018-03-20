<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable=['title'];

    protected $hidden=['updated_at'];

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }
}
