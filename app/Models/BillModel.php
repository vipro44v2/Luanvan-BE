<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BillModel extends Model
{
    use HasFactory;
    protected $table='bills';
    protected $primarykey='id';
    protected $fillable=['total_price','user_id','pay_mode','bill_status_id','create_at','update_at'];
    public function getBillByTheater($theater_id){
        $bills=DB::select('select DISTINCT bills.id ,users.name,bills.created_at,bills.total_price  from bills JOIN tickets on bills.id=tickets.bill_id join rooms on tickets.room_id=rooms.id JOIN users ON users.id=bills.user_id where rooms.theater_id  = ?', [$theater_id]);
        return $bills;
    }
    public function getCountTicket($id){
        $quantity=DB::select('SELECT COUNT( tickets.id) as quantity from tickets  JOIN bills on tickets.bill_id=bills.id WHERE bills.id=?', [$id]);
        return $quantity;
    }
}
