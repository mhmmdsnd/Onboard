<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstOnboard extends Model
{
    protected $table = "mst_onboard";

    public function onboardDtl()
    {
        return $this->hasOne('TrnOnboardDetail','mstobbId');
    }
}
