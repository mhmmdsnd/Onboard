<?php

namespace App\Http\Controllers;

use App\MstOnboard;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

#CLASS TAMBAHAN
use App\Grade;
use App\Onboard;
use App\OnboardDetail;
use GuzzleHttp\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->sendEmail = new Client(['verify' => false]);
        $this->grade = new Grade();
        $this->mstonboard = new MstOnboard();
        $this->onboard = new Onboard();
        $this->onboardDtl = new OnboardDetail();
    }
}
