<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdivision extends Model
{
    protected $table = "subdivision";

    public function division(){
        return $this->belongsTo(Division::class);
    }
}
