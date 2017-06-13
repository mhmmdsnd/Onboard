<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    protected $table = "workflow";
    protected $fillable = ["request_id","user_id","status","comment",
        "created_by","created_at","updated_by","updated_at"];
    protected $hidden = ["id"];

    public function users(){
        return $this->hasOne(User::class, 'id','user_id');
    }
    public function request(){
        return $this->belongsTo(OnRequest::class,'request_id');
    }
    public function workflows(){
        return $this->hasMany(WorkflowDetail::class,'workflow_id','id');
    }

}
