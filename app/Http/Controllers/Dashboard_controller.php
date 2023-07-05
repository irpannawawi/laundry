<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Tagihan;
use App\Models\User;
use App\Models\Water;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard_controller extends Controller
{
    //
    public function index(){
        $data = [
            'jumlah_pengguna'=> User::get()->count(),
        ];
        return view('dashboard_admin', $data);
    }
    
    public function pelanggan()
    {
        $data['pelanggan'] = User::where('role', 'pengguna')
                                    ->whereHas('log', function (Builder $query) {
                                        $query->where('created_at', 'like', date('Y-m').'%');
                                    })
                                    ->get();
        return view('admin.pelanggan.index', $data);
    }
    
    public function tagihan_admin()
    {
        if(Auth::user()->role != 'admin') return redirect('dashboard');
        
        //
        
        $data = [
            'tagihan_lalu' => Tagihan::orderby('id', 'desc')->get(),
            'tagihan_bulan_ini'=>Log::where('created_at', 'like', date('Y-m').'%')
                                    ->get()
                                    ->sum('pemakaian_air')*2000,
                
        ];
        return view('tagihan_pengguna', $data);
    }

    public function tagihan_user()
    {
        if(Auth::user()->role != 'pengguna') return redirect('dashboard');
        
        //
        
        $data = [
            'tagihan_lalu' => Tagihan::orderby('id', 'desc')->where('user_id', Auth::user()->id)->get(),
            'tagihan_bulan_ini'=>Log::where('created_at', 'like', date('Y-m').'%')
                                    ->where('user_id', Auth::user()->id)
                                    ->get()
                                    ->sum('pemakaian_air')*2000,
                
        ];
        return view('tagihan_pengguna', $data);
    }

    public function generate_tagihan()
    {
        if(Auth::user()->role != 'admin') return redirect('dashboard');

        //

        // get all pengguna
        $pengguna = User::where('role', 'pengguna')->get();
        foreach($pengguna as $usr)
        {
            // cek tiap pengguna apakah sudah ada tagihan bulan lalu
            // jika tidak ada maka buat baru
            $bulan_lalu = date('F-Y', strtotime('-1 months'));
            if(Tagihan::where(['user_id'=>$usr->id, 'bulan'=>$bulan_lalu])->count() <1){
                $jumlah_tagihan_lalu = Log::where('created_at', 'like', date('Y-m', strtotime('-1 Months')).'%')
                ->get()
                ->sum('pemakaian_air')*2000;
                $data_tagihan = [
                    'user_id'=>$usr->id,
                    'status_pembayaran'=>'belum',
                    'jumlah_tagihan'=>$jumlah_tagihan_lalu,
                    'bulan'=>$bulan_lalu,
                ];
                Tagihan::insert($data_tagihan);
            }          
        }
        return redirect('tagihan_pengguna')->with('success', 'Berhasil generate');
    }

    public function bayar_tagihan($id)
    {
        if(Auth::user()->role != 'admin') return redirect('dashboard');
        $tagihan = Tagihan::find($id);
        $tagihan->status_pembayaran = "lunas";
        $tagihan->save();
        return redirect()->back()->with('success', 'Berhasil dibayar');
    }
}
