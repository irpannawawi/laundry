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

    public function accept_order($id)
    {
        $trans = Transaction::find($id);
        $trans->transaction_status = 'accepted';
        if($trans->jadwal_jemput!=null){
            $trans->jadwal_jemput->status = 'Barang telah diterima toko';
        }
        $trans->save();

        return redirect()->back()->with('msg', 'Pesanan telah diterima');
    }

    public function cancel_order($id)
    {
        $trans = Transaction::find($id);
        $trans->transaction_status = 'canceled';
        if($trans->jadwal_jemput!=null){
            $trans->jadwal_jemput->status = 'dibatalkan';
        }
        $trans->save();

        return redirect()->back()->with('msg', 'Pesanan telah dibatalkan');
    }

}
