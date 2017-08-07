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
    public function subdivision(){
        return $this->hasOne(Subdivision::class,'id','subdivision_id');
    }
    public function suggested_list(){
        return $this->hasMany(SuggestedList::class,'item_id','id');
    }
    public function prepared_item() {
        return $this->hasMany(PreparedItem::class,'item_id','id');
    }
    public function checked_item(){
        return $this->hasMany(CheckedItem::class, 'item_id','id');
    }
    public function employee_item(){
        return $this->hasMany(OnboardItem::class,'item_id','id');
    }
}
