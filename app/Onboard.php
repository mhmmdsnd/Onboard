<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Onboard extends Model
{
    protected $table = "onboard";
    protected $fillable = ['name','division_id','company_id','joindate','workplace_id', 'email','subdivision_id','position_id','title',
        'grade_id','division_name','subdivision_name','request_name','created_at','created_by','updated_by','updated_at'];

    protected $hidden = ['id'];
    protected $default = [];

    public function company(){
        return $this->hasOne(Company::class,'id','company_id');
    }
    public function division(){
        return $this->hasOne(Division::class,'id','division_id');
    }
    public function subdivision(){
        return $this->hasOne(Subdivision::class,'id','subdivision_id');
    }
    public function workplace(){
        return $this->hasOne(Workplace::class,'id','workplace_id');
    }
    public function position(){
        return $this->hasOne(Position::class,'id','position_id');
    }
    public function grade(){
        return $this->hasOne(Grade::class,'id','grade_id');
    }
    public function onboard_detail()
    {
        return $this->hasMany(OnboardDetail::class,'onboard_id','id');
    }
    public function onboard_item(){
        return $this->hasOne(OnboardItem::class,'onboard_id','id');
    }
    public function workflow(){
        return $this->hasMany(Workflow::class,'onboard_id','id');
    }
    public function onrequest(){
        return $this->hasOne(OnRequest::class,'onboard_id','id');
    }

}
