<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "item";
    protected $fillable = ["item_category", "name","brand","description","created_at, updated_at"];
    protected $hidden = ["id"];

    public function itemcategory(){
        return $this->hasOne(ItemCategory::class,'id','item_category');
    }

}
