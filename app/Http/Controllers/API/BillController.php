<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\BillModel;

class BillController extends BaseController
{
    public function create(Request $r){
        $bill=BillModel::create([
            'user_id'=>$r->user_id,
            'total_price'=>0,
            'pay_mode'=>$r->pay_mode,
            'bill_status_id'=>1
        ]);
        if($bill){
            return response()->json([
                'data'=>$bill,
                'status_code'=>200,
                'message'=>'Done'
                ]);
            }
            else
            {
                return response()->json([
                    'data'=>null,
                    'status_code'=>404,
                    'message'=>'Error'
                ]);
            
        }
    }
}
