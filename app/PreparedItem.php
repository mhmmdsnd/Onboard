<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreparedItem extends Model
{
    protected $table = "prepared_item";
    protected $fillable = ["request_id","item_id",
        "created_by","created_at","updated_by","updated_at"];
    protected $hidden = ['id'];

    public function request(){
        return $this->hasOne(OnRequest::class,'id','request_id');
    }
    public function item(){
        return $this->hasOne(Item::class,'id','item_id');
    }
    public function workflows(){
        return $this->hasOne(Workflow::class,'request_id','request_id');
    }
}
