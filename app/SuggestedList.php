<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuggestedList extends Model
{
    #ADA PENAMBAHANAN 1 FIELD DI SUGGESTED LIST
    protected $table = "suggested_list";
    protected $fillable = ["holding_id","company_id","division_id","grade_id","item_id",
        "created_by","created_at","updated_by","updated_at"];
    protected $hidden = ['id'];

    public function holding(){
        return $this->hasOne(Holding::class,'id','holding_id');
    }
    public function company(){
        return $this->hasOne(Company::class,'id','company_id');
    }
    public function division(){
        return $this->hasOne(Division::class,'id','division_id');
    }
    public function grade(){
        return $this->hasOne(Grade::class,'id','grade_id');
    }
    public function item(){
        return $this->hasOne(Item::class,'id','item_id');
    }
}
