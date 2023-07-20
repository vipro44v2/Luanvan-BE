<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\MovieModel;
use App\Models\TheaterModel;
use App\Models\CalendarModel;
use App\Models\TicketModel;
use App\Models\ShowtimeModel;
use App\Models\SeatRoomModel;
use App\Models\BillModel;

class TicketController extends BaseController
{
    public function buyTicket($id){
        $movie=MovieModel::all();
        $theater=TheaterModel::find($id);
        $calendar=CalendarModel::getCalendarByMovie($movie[0]->id);
        $schedule=CalendarModel::getTime($id,$calendar[0]->id);
        return view("Ticket.buyTicket",compact("movie","theater","calendar","schedule"));
    }
    public function createTicket(Request $request){
        $bill=BillModel::create([
            'user_id'=>999,
            'total_price'=>0,
            'pay_mode'=>"Thanh toán trực tiếp",
            'bill_status_id'=>2
        ]);
        $showtime=ShowtimeModel::getShowtimeByCalendar($request->input("calendar_select"),$request->input("schedule_select"));
        $quantity=$request->input("quantity");
        $quantity_children=$request->input("children_quantity");
        $quantity_aldult=$quantity;
        if($quantity_children){
            $quantity_aldult=$quantity-$quantity_children;
        }
        $vt=0;
        $room_id=$showtime[$vt]->room_id;
        $listSeat=SeatRoomModel::getSeatByRoom($room_id);
        $bill->total_price=$quantity_aldult*60000+$quantity_children*45000;
        foreach($listSeat as $item){
            if($item->id==$request->input($item->id)){
                if($quantity_aldult!=0)
                {
                    TicketModel::create([
                        'seat_id'=>$item->id,
                        'ticket_type_id'=>2,
                        'movie_price_id'=>1,
                        'room_id'=>$room_id,
                        'schedule_id'=>$request->input("schedule_select"),
                        'bill_id'=>$bill->id,
                        'calendars_id'=>$request->input("calendar_select")
                    ]);
                    $quantity_aldult--;
                }
                else
                {
                    TicketModel::create([
                        'seat_id'=>$item->id,
                        'ticket_type_id'=>1,
                        'movie_price_id'=>1,
                        'room_id'=>$room_id,
                        'schedule_id'=>$request->input("schedule_select"),
                        'bill_id'=>$bill->id,
                        'calendars_id'=>$request->input("calendar_select")
                    ]);
                }
                
            }
        }        
        $bill->save();
        return redirect("/ticket/buyTicket/1");
    }
}
