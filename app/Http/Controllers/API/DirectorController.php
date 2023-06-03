<?php

namespace App\Http\Controllers\API;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\DirectorModel;
use Illuminate\Http\Request;

class DirectorController extends BaseController
{
    public function getAll(){
       $director=DirectorModel::all();
        if($director)
        {
            return response()->json([
            'data'=>$director,
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
