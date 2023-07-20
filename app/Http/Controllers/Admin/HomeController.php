<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\BillModel;

class HomeController extends BaseController
{
    public function home(){
        $date= date('y-m-d');
        $bill=BillModel::all();
        $total = 0;
        $quantity=0;
        foreach ($bill as $item ) {
            if($date== $item->created_at->format('y-m-d')){
                $total+=$item->total_price;
                $ticket=BillModel::getCountTicket($item->id);
                $quantity+=$ticket[0]->quantity;
            }
        }
        return view('/home',compact('total','quantity'));
    }
}
