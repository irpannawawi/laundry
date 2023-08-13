<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Produk;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    //

    public function index()
    {
        $data['discounts'] = Discount::get();
        $data['product_list'] = Produk::get();
        return view('admin.discounts.index', $data);
    }

    public function create(Request $request)
    {
        $data = [
            'discount_code'=> $request->discount_code,
            'discount_name'=> $request->discount_name,
            'discount_type'=> $request->discount_type,
            'product_selected'=> $request->product_selected,
            'total_discount'=> $request->total_discount,
        ];
        
        Discount::create($data);
        return redirect()->back()->with('success', 'Berhasil menambah diskon');
    }


    public function delete($id)
    {
        Discount::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus diskon');

    }
}
