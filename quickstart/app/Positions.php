<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    public function workers()
    {
        return $this->hasMany(Workers::class);
    }
}
