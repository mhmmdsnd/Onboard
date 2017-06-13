<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ITCategory extends Model
{
    protected $table = "itcategory";
    protected $fillable = ["name"," created_at"," updated_at"];
    protected $hidden = ["id"];

    public function itemcategory()
    {
        return $this->hasMany(ItemCategory::class,'it_category','id');
    }
}
