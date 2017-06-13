<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    //
    protected $table = "division";

    public function subdivision(){
        return $this->hasMany(Subdivision::class);
    }
}
