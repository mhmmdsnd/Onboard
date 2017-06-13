<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    protected $table = "itemcategory";
    protected $fillable = ["name", "it_category","created_at, updated_at"];
    protected $hidden = ["id"];

    public function itcategory(){
        return $this->hasOne(ITCategory::class,'id','it_category');
    }
    public function item(){
        return $this->hasMany(Item::class,'item_category','id');
    }
}
