<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnboardItem extends Model
{
    protected $table = "onboard_item";
    protected $fillable = ["onboard_id","item_id",
        "created_by","created_at","updated_by","updated_at"];
    protected $hidden = ['id'];

    public function item(){
        return $this->hasOne(Item::class,'id','item_id');
    }
}
