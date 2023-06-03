<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\MovieStatusModel;

class MovieStatusController extends BaseController
{
    public function getAll(){
        $status=MovieStatusModel::all();
         if($status)
         {
             return response()->json([
             'data'=>$status,
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
