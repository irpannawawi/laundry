<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //
    public function cartView()
    {
        $data = [
            'cart_list'=> Cart::where('id_user', Auth::user()->id)->get(),
        ];

        return view('public.cart', $data);
    }

    public function addToCart($id_product){
        // check if product alredy in cart
        $cart = Cart::where(['id_product'=>$id_product, 'id_user'=>Auth::user()->id])->get();
        if($cart->count() < 1)
        {
            // add to cart
            $data = [
                'id_user'=>Auth::user()->id,
                'id_product'=>$id_product
            ];
            Cart::insert($data);
        }
        Session::flash('msg', 'Berhasil menambah ke keranjang!');
        return redirect('/#layanan');
    }

    public function removeFromCart($id_product){
        // check if product alredy in cart
        Cart::where(['id_product'=>$id_product, 'id_user'=>Auth::user()->id])->delete();
        Session::flash('msg', 'Berhasil menghapus dari keranjang!');
        return redirect()->back();
    }
}
