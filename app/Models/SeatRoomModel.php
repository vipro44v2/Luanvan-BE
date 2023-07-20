<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeatRoomModel extends Model
{
    use HasFactory;
    protected $table='seat_rooms';
    // protected $primaryKey=array('seat_id','room_id');
    protected $fillable=['seat_id','room_id'];
    public $timestamps=false;
    public function getSeatByRoom($id){
        $list= DB::table('seat_rooms')
        ->join('seats','seat_rooms.seat_id', '=', 'seats.id')
        ->where('seat_rooms.room_id','=',$id)
        ->select('seats.id','seats.name')
        ->get();
        return $list;
    }
}
