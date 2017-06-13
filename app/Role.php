<?php

namespace App;

use Laratrust\LaratrustRole;

class Role extends LaratrustRole
{
    protected $table = "roles";
    protected $fillable = ["name","display_name","description",
        "created_by","created_at","updated_by","updated_at"];
    protected $hidden = ['id'];


}
