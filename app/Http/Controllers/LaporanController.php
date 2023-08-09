<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use DateTime;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tgl_start=date('Y-m').'-01';
        
        $tgl_end = new DateTime('now');
        $tgl_end->modify('last day of this month')->format('Y-m-d');
        $tgl_end = date_format($tgl_end, 'Y-m-d');
        // dd($this->laporan_prnjualan($tgl_start, $tgl_end));
        $page=1;
        if($request->search){
            
            $tgl_start=$request->tgl_start;
            $tgl_end=$request->tgl_end;
            $page = $request->page;
        }
        $data = [
            'page'=>$page,
            'tgl_start'=>$tgl_start,
            'tgl_end'=>$tgl_end,
            'orderList'=>$this->laporan_keuangan($tgl_start, $tgl_end),
            'itemList'=>$this->laporan_prnjualan($tgl_start, $tgl_end),
        ];   
      return view('admin.laporan.index', $data);   
    }

    public function laporan_keuangan($start, $end)
    {
        return Transaction::where('transaction_status', 'finish')
        ->whereDate('created_at', '>=', $start)
        ->whereDate('created_at', '<=', $end)
        ->orderBy('id_transaction', 'DESC')
        ->get();
    }

    public function laporan_prnjualan($start, $end)
    {
        $itemList = TransactionItem::distinct()->get('product_name');

        $items = [];
        foreach ($itemList as $item)
        {
            
            $toAdd = [
                'product_name' => $item->product_name,
                'total_terjual' => TransactionItem::where('product_name', $item->product_name)
                ->whereHas('transaction', function($query){
                    $query->where('transaction_status', 'finish');
                })
                ->get()->sum('berat'),
                'price' =>TransactionItem::where('product_name', $item->product_name)->get('price')[0]->price,
            ];
            $toAdd['total_price'] = $toAdd['total_terjual']*$toAdd['price'];
            array_push($items, $toAdd);
        }
        return $items;
    }
}
