<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function validateJson(array $jsonData, array $rules ){
        $validator = Validator::make($jsonData, $rules );
        return $validator;
    }

    public function validateValidInputs(Request $request){

       
        $orderType = $request->json()->get('order_type');

    }

}
