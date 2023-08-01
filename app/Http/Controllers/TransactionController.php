<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payment;
use App\Models\Produk;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    //

    public function view(){
        $data['transaction_list'] = Transaction::where('id_user', Auth::user()->id)->get();
        return view('public.transaction', $data);
    }
    public function add(Request $request)
    {
        $jenis_layanan = $request->input('jenis_layanan');
        $payment_method = $request->input('pembayaran');
        $jemput = $request->input('jemput');
        // add payment
        $payment = new Payment;
        $payment->payment_type = $payment_method;
        $payment->status = 'Menunggu ditimbang';
        $payment->price = 0;
        $payment->save();

        $trans = new Transaction;
        
        $trans->transaction_status = 'Ordered';
        $trans->id_payment = $payment->id_payment;
        $trans->id_transaction_item = '-';
        $trans->id_user = Auth::user()->id;
        $trans->save();

    
        // add items
        foreach($request->input('items') as $item){
            $produk = Produk::find($item);
            
            $data = [
                'product_name'=>$produk->product_name,
                'picture'=>$produk->picture,
                'price'=>0,
                'id_transaction'=>$trans->id_transaction,
                'setrika'=>$jenis_layanan,
                'is_deleted'=>0,
                'berat'=>0
            ];
        }
        TransactionItem::insert($data);

        // make cart empty
        Cart::where('id_user', Auth::user()->id)->delete();
        // redirect to transaction page
        return redirect()->route('transaction');
    }
}
