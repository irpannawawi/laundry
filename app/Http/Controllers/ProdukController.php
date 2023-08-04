<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    
    public function index()
    {
        //
        $data = [
            'produks' => Produk::get(),
        ];
        return view('admin.produk.index', $data);
    }




    public function store(Request $request)
    {
        // file uploading
        $file = $request->file('picture');
        $file_name = date('dmYHis').'.'.$file->extension();
        $path = $file->storeAs('public/produk', $file_name);
        // insering to database
        $data = [
            'product_name'=> $request->input('product_name'),
            'descriptions'=>'-',
            'price'=>$request->input('price'),
            'picture'=>$file_name,
            'is_deleted'=>false
        ];
        Produk::insert($data);
        // redirect to produk page
        return redirect()->back()->with('success', 'berhasil tambah produk');
    }


    public function edit($id)
    {
        $data['produk'] = Produk::find($id);
        return view('admin.produk.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $produk = Produk::find($request->input('id_product'));
        $produk->product_name = $request->input('product_name');
        $produk->descriptions = '-';
        $produk->price = $request->input('price');

        if(!empty($request->file('picture'))){
            //remove old picture
            Storage::delete('public/produk/'.$produk->picture);
            // upload new pic
            $file = $request->file('picture');
            $file_name = date('dmYHis').'.'.$file->extension();
            $path = $file->storeAs('public/produk', $file_name);
            $produk->picture = $file_name;
        }
        $produk->save();

        return redirect()->route('produk');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        Produk::find($id)->delete();
        return redirect()->route('produk');
    }
}
