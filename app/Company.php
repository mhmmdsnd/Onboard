<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "company";
    protected $fillable = ['name','holdingId','created_at','updated_by','created_by','updated_by'];
    protected $hidden = ['id'];

    public function holding()
    {
        return $this->hasOne(Holding::class,'id','holdingId');
    }
}
