<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //

    public function index(){
        $data = [
            'orderList'=>Transaction::where('transaction_status', 'ordered')->orderBy('id_transaction', 'DESC')->get(),
        ];
        // dd($data['orderList'][0]->user);
        return view('admin.order.index', $data);
    }
}
