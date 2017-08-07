<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdivision extends Model
{
    protected $table = "subdivision";

    public function division(){
        return $this->belongsTo(Division::class);
    }
    public function item(){
        return $this->hasMany(Item::class,'subdivision_id','id');
    }
    public function roleuser() {
        return $this->hasOne(RoleUser::class,'role_id','role_id');
    }
}
