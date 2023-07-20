<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TicketModel;
use App\Models\MoviePriceModel;

class TicketController extends BaseController
{
    public function getAll(){
        $ticket=TicketModel::all();
        if($ticket){
            return response()->json([
            'data'=>$ticket,
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
        public function create(Request $r) {
            $ticket=TicketModel::create([
                "seat_id"=>$r->seat_id,
                "ticket_type_id"=>$r->ticket_type_id,
                "movie_price_id"=>$r->movie_price_id,
                "prices"=>70000,
                "room_id"=>$r->room_id,
                "schedule_id"=>$r->schedule_id,
                "bill_id"=>$r->bill_id,
                "calendars_id"=>$r->calendars_id
            ]);
            if($ticket){
                return response()->json([
                'data'=>$ticket,
                'status_code'=>200,
                'message'=>'Mua vé thành công'
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
        public function getPrice(){
            $prices=MoviePriceModel::all();
            if($prices)
            {
                return response()->json([
                'data'=>$prices,
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
