<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = "role_user";
    protected $fillable = ["user_id","role_id","user_type"];

    public function users(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function roles(){
        return $this->hasOne(Role::class,'id','role_id');
    }
}
