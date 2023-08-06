<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function invoice($id){
        $data['transaction'] = Transaction::find($id);
        return view('invoice', $data);
    }
}
