<?php

namespace App;

use Hamcrest\Core\CombinableMatcherTest;
use Illuminate\Database\Eloquent\Model;

class Holding extends Model
{
    protected $table = "holding";
    protected $fillable = ['name','created_at','updated_by','created_by','updated_by'];
    protected $hidden = ['id'];

    public function company()
    {
        return $this->hasMany(Company::class,'holding_id','id');
    }
}
