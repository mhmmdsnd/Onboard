<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClearedItem extends Model
{
    protected $table = "cleared_item";
    public function item(){
        return $this->hasOne(Item::class,'id','item_id');
    }
}
