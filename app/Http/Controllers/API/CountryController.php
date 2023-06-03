<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\CountryModel;

class CountryController extends BaseController
{
    public function getAll(){
        $country=CountryModel::all();
        if($country)
        {
            return response()->json([
            'data'=>$country,
            'status_code'=>200,
            'message'=>'done'
            ]);
        }
        else
        {
            return response()->json([
                'data'=>null,
                'status_code'=>404,
                'message'=>'error'
            ]);
        }
    }
}
