<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\JadwalJemput;
use App\Models\Payment;
use App\Models\Produk;
use App\Models\Saldo;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    //

    public function view()
    {
        $data['transaction_list'] = Transaction::where('id_user', Auth::user()->id)->orderBy('id_transaction', 'DESC')->get();
        return view('public.transaction', $data);
    }
    public function history()
    {
        $data['transaction_list'] = Transaction::where('id_user', Auth::user()->id)->orderBy('id_transaction', 'DESC')->get();
        return view('public.history', $data);
    }
    public function add(Request $request)
    {
        $jenis_layanan = $request->input('jenis_layanan');
        $payment_method = $request->input('pembayaran');
        $jemput = $request->input('jemput');

        // add payment
        $payment = new Payment;
        $payment->payment_type = $payment_method;
        if ($payment_method == 'COD') {
            $payment->status = 'Menunggu diproses';
        } else {
            $payment->status = 'Menunggu pembayaran';
        }
        $payment->price = 0;
        $payment->save();

        // add transaction
        $trans = new Transaction;
        $trans->transaction_status = 'Ordered';
        $trans->id_payment = $payment->id_payment;
        $trans->id_transaction_item = '-';
        $trans->id_user = Auth::user()->id;
        $trans->save();


        // add items
        $total_price = 0;
        foreach ($request->input('items') as $item) {
            $produk = Produk::find($item);
            $price = $produk->price;
            $berat = 1;

            if ($produk->product_name == 'Pakaian Harian') {
                if ($jenis_layanan == 'Cuci + Setrika') {
                    $price = $produk->price + 2000;
                }
                $berat = $request->input('berat');
            }

            if ($jenis_layanan == null) {
                $jenis_layanan = '-';
            }

            $data = [
                'product_name' => $produk->product_name,
                'picture' => $produk->picture,
                'price' => $price,
                'id_transaction' => $trans->id_transaction,
                'setrika' => $jenis_layanan,
                'is_deleted' => 0,
                'berat' => $berat
            ];
            $total_price += $price*$berat;
            TransactionItem::insert($data);
        }
        
        $payment->price = $total_price;
        $discount = 0;
        $payment->with_discount = 0;
        if($request->discount!=null){
            $payment->with_discount = $request->discount;
            $discount = $request->discount;
        }
        $total_price = $total_price-$discount;
        if(isset($request->saldo)){
            if($request->saldo < $total_price){
                $saldo = $request->saldo;
            }else{
                $saldo = $total_price;
            }
            $payment->with_saldo = $saldo;
            $dataSaldo = [
                'saldo'=>$saldo,
                'ket'=>'Penggunaan transaksi',
                'user_id'=>Auth::user()->id,
                'type'=>'keluar'
            ];
            Saldo::create($dataSaldo);
        }
        if($payment->price - ($payment->with_saldo+$payment->with_discount) < 1 )
        {
            $payment->status = 'Paid';
        }
        $payment->save();

        // add jadwal 
        if ($jemput != 'Mandiri') {
            $tanggal_jemput = $this->convert_tanggal($request->input('jadwal_jemput'));
            $jam_jemput = $request->input('jadwal_jam');
            $jadwal_jemput = [
                'tanggal' => $tanggal_jemput,
                'jam' => $jam_jemput,
                'status' => 'Menunggu',
                'id_transaction' => $trans->id_transaction,
            ];

            JadwalJemput::insert($jadwal_jemput);
        }

        // make cart empty
        Cart::where('id_user', Auth::user()->id)->delete();
        
        // redirect to transaction page
        return redirect()->route('transaction');
    }

    public function addPaymentInfo(Request $request){
        // file uploading
        $file = $request->file('bukti');
        $file_name = date('dmYHis').'.'.$file->extension();
        $path = $file->storeAs('public/bukti', $file_name);
        $trans = Transaction::find($request->input('id_transaction'));
        $trans->payment->payment_info = $file_name;
        $trans->payment->status = 'Paid';
        $trans->payment->save();
        return redirect()->back();
    }
    public function convert_tanggal($tgl)
    {
        $t = explode('-', $tgl);
        switch ($t[1]) {
            case '01':
                $tanggal = 'Januari';
                break;
            case '02':
                $tanggal = 'Februari';
                break;
            case '03':
                $tanggal = 'Maret';
                break;
            case '04':
                $tanggal = 'April';
                break;
            case '05':
                $tanggal = 'Mei';
                break;
            case '06':
                $tanggal = 'Juni';
                break;
            case '07':
                $tanggal = 'Juli';
                break;
            case '08':
                $tanggal = 'Agustus';
                break;
            case '09':
                $tanggal = 'September';
                break;
            case '10':
                $tanggal = 'Oktober';
                break;
            case '11':
                $tanggal = 'November';
                break;
            case '12':
                $tanggal = 'Desember';
                break;
        }
        return $t[2].' '.$tanggal.' '.$t[0];
    }

    public function proccess()
    {
        
    }
}
