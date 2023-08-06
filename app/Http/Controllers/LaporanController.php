<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tgl_start=date('Y-m-d');
        $tgl_end=date('Y-m-d', strtotime("+1 month", strtotime('now')));
        if($request->search){
            
            $tgl_start=$request->tgl_start;
            $tgl_end=$request->tgl_end;
            
        }
        $data = [
            'tgl_start'=>$tgl_start,
            'tgl_end'=>$tgl_end,
            'orderList'=>Transaction::where('transaction_status', 'finish')
            ->whereDate('created_at', '>=', $tgl_start)
            ->whereDate('created_at', '<=', $tgl_end)
            ->orderBy('id_transaction', 'DESC')
            ->get(),
        ];   
      return view('admin.laporan.index', $data);   
    }
}
