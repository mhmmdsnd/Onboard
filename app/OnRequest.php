<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnRequest extends Model
{
    protected $table = "request";
    protected $fillable = ['onboard_id','request_date','request_by','ticket','delivery_date','type_request',
        'created_by','created_at','updated_by','updated_at'];
    protected $hidden = ['id'];

    public function onboard(){
        return $this->hasOne(Onboard::class,'id','onboard_id');
    }
}
