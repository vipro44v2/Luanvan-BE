<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\BillModel;
use App\Models\TicketModel;
use App\Models\TheaterModel;

class BillController extends BaseController
{
    public function listBill($id){
        $theater=TheaterModel::find($id);
        $bill=BillModel::getBillByTheater($id);
        return view('Bill.listBill',compact('bill','theater'));
    }
    public function getDetail($theater_id,$bill_id){
        $theater=TheaterModel::find($theater_id);
        $tickets=TicketModel::getTicketByBill($bill_id);
        $vt=0;
        foreach ($tickets as $item){           
            $listticket[$vt++]=$ticketInfo=TicketModel::getTicket($item->id);
        }
        $quantity=count($listticket);
        return view('Bill.billDetail',compact('listticket','theater','quantity'));
    }
}
