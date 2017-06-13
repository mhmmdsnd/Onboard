<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnboardDetail extends Model
{
    protected $table = "onboard_detail";
    protected $fillable = ["onboard_id","user_id","itemcat_id","is_checked",
        "created_by","created_at","updated_by","updated_at"];
    protected $hidden = ['id'];

    public function itemcategory (){
        return $this->hasOne();
    }
    public function users(){
        return $this->hasOne(User::class, 'id','user_id');
    }
}
