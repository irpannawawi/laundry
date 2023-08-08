<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PublicController extends Controller
{
    //
    public function index(){
        $data = [
            'products'=>Produk::get(),
        ];

        if(Auth::user()!=null){
            $data['cart_count'] = Cart::where('id_user',Auth::user()->id)->get()->count();
        }
        return view('public.index', $data);
    }

    public function about(){
        
        return view('public.about');
    }

    public function profile()
    {
        $data = ['profile'=>User::find(Auth::user()->id)];
        return view('public.profile', $data);
    }

    public function update_profile(Request $request, $id){
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $message = "Data berhasil dirubah";

        // change password
        if(!empty($request->input('old_password'))){
            if($request->input('new_password') === $request->input('confirm_password') && Hash::check($request->input('old_password'), $user->password)){
                $user->password = Hash::make($request->input('new_password'));
                $message = $message.", password dirubah";
            }
        }

        // has image 
        if(!empty($request->file('avatar'))){
            // upload new pic
            $file = $request->file('avatar');
            $file_name = date('dmYHis').'.'.$file->extension();
            $path = $file->storeAs('public/avatar', $file_name);
            $user->avatar = $file_name;
        }
        $user->save();
        return redirect()->back()->with('message', $message);
    }
}
