<?php

namespace App\Http\Controllers;

use App\Models\JadwalAntar;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ProccessController extends Controller
{
    //
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
    public function index(){
        $data = [
            'orderList'=>Transaction::where('transaction_status', 'accepted')->orWhere('transaction_status', 'proccess')->orWhere('transaction_status', 'shipment')->orderBy('id_transaction', 'DESC')->get(),
        ];
        // dd($data['orderList'][0]->user);
        return view('admin.proccess.index', $data);
    }

    public function toProccess($id)
    {
        $trans = Transaction::find($id);
        $trans->transaction_status = 'proccess';
        $trans->save();

        return redirect()->back()->with('msg', 'Berhasil, Pesanan dalam proses');
    }

    
    public function completeProccess($id)
    {
        $trans = Transaction::find($id);
        $trans->transaction_status = 'shipment';
        $trans->save();

        return redirect()->back()->with('msg', 'Berhasil, Pesanan telah selesai');
    }

    public function toFinish($id)
    {
        $trans = Transaction::find($id);
        $trans->transaction_status = 'finish';
        if($trans->jadwal_antar!=null){
            $trans->jadwal_antar->status = 'Terkirim';
        }
        $trans->save();

        return redirect()->back()->with('msg', 'Berhasil, Pesanan telah selesai');
    }

    public function toShipment(Request $request)
    {
        $id = $request->id_transaction;
        $tanggal = $this->convert_tanggal($request->tanggal);
        $jam = $request->jam;
        
        $trans = Transaction::find($id);
        $trans->transaction_status = 'shipment';
        $trans->save();
        
        // insert jadwal antar
        JadwalAntar::insert([
            'id_transaction'=>$id,
            'tanggal'=>$tanggal,
            'jam'=>$jam,
            'status'=>'Menunggu Pengantaran oleh toko'
        ]);
        return redirect()->back()->with('msg', 'Berhasil, Pesanan siap diantarkan');
    }

    public function transaction_finished()
    {
        $data = [
            'orderList'=>Transaction::where('transaction_status', 'finish')->orderBy('id_transaction', 'DESC')->get(),
        ];
        // dd($data['orderList'][0]->user);
        return view('admin.proccess.finish', $data);
    }

}
