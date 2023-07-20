<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RoomModel extends Model
{
    use HasFactory;
    protected $table='rooms';
    protected $primaryKey="id";
    protected $fillable=['id','name','slot','theater_id','room_status_id'];
    public $timestamps=false;
    public function getRoomByTheater($id){
        $rooms=DB::select('select * from rooms where theater_id = ?', [$id]);
        return $rooms;
    }
}
