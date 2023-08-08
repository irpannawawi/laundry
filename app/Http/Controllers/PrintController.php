<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
class PrintController extends Controller
{
    public function invoice($id){
        $data['transaction'] = Transaction::find($id);
        return view('invoice', $data);
    }

    public function print_keuangan($start, $end)
    {
        $trans = Transaction::where('transaction_status', 'finish')
        ->whereDate('created_at', '>=', $start)
        ->whereDate('created_at', '<=', $end)
        ->orderBy('id_transaction', 'DESC')
        ->get();
        $data = ['orderList'=>$trans, 'tgl_start'=>$start, 'tgl_end'=>$end];
        return view('admin.laporan.print_keuangan', $data);
    }
    public function print_penjualan($start, $end)
    {
        $itemList = TransactionItem::distinct()->get('product_name');

        $items = [];
        foreach ($itemList as $item)
        {
            
            $toAdd = [
                'product_name' => $item->product_name,
                'total_terjual' => TransactionItem::where('product_name', $item->product_name)->get()->sum('berat'),
                'price' =>TransactionItem::where('product_name', $item->product_name)->get('price')[0]->price,
            ];
            $toAdd['total_price'] = $toAdd['total_terjual']*$toAdd['price'];
            array_push($items, $toAdd);
        }
        $data['itemList'] = $items;
        $data['tgl_start'] = $start;
        $data['tgl_end'] = $end;
        return view('admin.laporan.print_penjualan', $data);
    }
}
