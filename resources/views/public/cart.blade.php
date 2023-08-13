@extends('layouts.public_layout')
@section('manualCss')
    <style>
        .form-control {
            border: 1px solid #cfd1d8;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            background: #ffffff;
            color: #2e323c;
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="container mt-5 mb-3">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil</strong> {{ Session::get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
        @endif
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item text-dark">
                            <a href="{{ route('publicProfile') }}" class="nav-link link-dark" aria-current="page">
                                <i class="fa fa-user"></i>
                                Profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cart') }}" class="nav-link active">
                                <i class="fa fa-shopping-cart"></i>
                                Keranjang
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('transaction')}}" class="nav-link link-dark">
                                <i class="fa fa-table"></i>
                                Transaksi
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('history')}}" class="nav-link link-dark">
                                <i class="fa fa-history"></i>
                                History
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{route('riwayatSaldo')}}" class="nav-link link-dark">
                                <i class="fa fa-money"></i>
                                History Saldo
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <form action="{{route('addTransaction')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            @if ($cart_list->count() == 0)
                                <p class="text-muted text-center">Keranjang Kosong</p>
                            @endif
                            <div class="row">
                                @php
                                    $has_pakaian_harian = False;
                                @endphp 

                                @foreach ($cart_list as $item)
                                @php
                                    if($item->product->product_name == 'Pakaian Harian' && $has_pakaian_harian == False){
                                        $has_pakaian_harian = True;
                                    }
                                @endphp
                                <input type="hidden" name="items[]" value="{{$item->id_product}}">
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100">
                                            <img src="{{ Storage::url('produk/' . $item->product->picture) }}"
                                                class="card-img-top" alt="..." height="140" width="200">
                                            <div class="card-body">
                                                <ul class="list-unstyled d-flex justify-content-between">
                                                    <li class="text-right">Rp.
                                                        {{ number_format($item->product->price, 0, ',', '.') }}{{$item->product->product_name == 'Pakaian Harian'?'/Kg':''}}</li>
                                                </ul>
                                                <p href="#" class="h2 text-decoration-none text-dark">
                                                    {{ $item->product->product_name }}</p>
                                                </div>
                                                <div class="card-footer" style="background-color: white; border: 0px">
                                                    @if (Auth::user() != null)
                                                        <a href="{{ route('removeFromCart', ['id_product' => $item->product->id_product]) }}"
                                                            class="btn btn-danger float-end" >Batal</a>
                                                    @endif
                                                </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if ($has_pakaian_harian)
                            <div class="row">
                                    
                                <div class="col-12">
                                    <h4>Jenis Layanan</h4>
                                    <div class="form-group">
                                        <select class="form-control" name="jenis_layanan" id="jenisLayanan">
                                            <option value="Cuci Bersih">Cuci Bersih</option>
                                            <option value="Cuci + Setrika">Cuci + Setrika</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <h4>Berat Pakaian (Kg)</h4>
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="berat" id="berat" value="1" min="1" />
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-12">
                                    <h4>Penjemputan</h4>
                                    <div class="form-group">
                                        <select onchange="changePenjemputan()" class="form-control" name="jemput" id="jemput">
                                            <option value="Mandiri">Mandiri</option>
                                            <option value="Antar Jemput">Antar Jemput</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row" id="jadwalPenjemputan" class="">
                                <h4>Jadwal penjemputan</h4>
                                <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label for="jadwal">Tanggal</label>
                                        <input type="date" name="jadwal_jemput" id="jadwal" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label for="jadwal">Jam</label>
                                        <select name="jadwal_jam" id="jadwalJam" class="form-control">
                                            <option {{ (date('H')>7) && (date('H') <= 8)?'selected':'' }} value="08:00">08:00</option>
                                            <option {{ (date('H')>8) && (date('H') <= 9)?'selected':'' }} value="09:00">09:00</option>
                                            <option {{ (date('H')>9) && (date('H') <= 10)?'selected':'' }} value="10:00">10:00</option>
                                            <option {{ (date('H')>10) && (date('H') <= 11)?'selected':'' }} value="11:00">11:00</option>
                                            <option {{ (date('H')>11) && (date('H') <= 12)?'selected':'' }} value="12:00">12:00</option>
                                            <option {{ (date('H')>12) && (date('H') <= 13)?'selected':'' }} value="13:00">13:00</option>
                                            <option {{ (date('H')>13) && (date('H') <= 14)?'selected':'' }} value="14:00">14:00</option>
                                            <option {{ (date('H')>14) && (date('H') <= 15)?'selected':'' }} value="15:00">15:00</option>
                                            <option {{ (date('H')>15) && (date('H') <= 16)?'selected':'' }} value="16:00">16:00</option>
                                            <option {{ (date('H')>16) && (date('H') <= 17)?'selected':'' }} value="17:00">17:00</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
    
                            
    
                            <div class="row" id="pembayaran" class="">
                                <div class="col-md-6 col-lg-6">
                                    <h4>Metode Pembayaran</h4>
                                    <select class="form-control" name="pembayaran" id="pembayaran">
                                        <option value="COD">COD (Bayar di Tempat)</option>
                                        <option value="Transfer">Transfer</option>
                                    </select>
                                </div>
                            </div>
                            @if (Auth::user()->is_membership==1)
                            <div class="row"  class="border border-warning m-1 p-4 bg-dark">
                                <div class="col">
                                    <span class="badge bg-warning"><i class="fas fa-crown"></i> Fitur spesial member </span>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="discount">Voucher tersedia</label>
                                    <select class="form-control" name="discount" id="discount">
                                        <option value="null">-</option>
                                        @foreach ($discounts as $discount)
                                            @if ($discount->discount_type=='item')
                                                @if ($cart_list->where(['product_id'=>$discount->product_selected])->count()>0)
                                                    
                                                <option value="{{$discount->total_discount}}">({{$discount->discount_code}}) {{$discount->discount_name}}</option>
                                                @endif
                                            @else
                                                <option value="{{$discount->total_discount}}">({{$discount->discount_code}}) {{$discount->discount_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-group m-2">
                                        <input class="form-check-input" type="checkbox" value="{{(\App\Models\Saldo::where(['user_id'=>Auth::user()->id, 'type'=>'masuk'])->sum('saldo'))-(\App\Models\Saldo::where(['user_id'=>Auth::user()->id, 'type'=>'keluar'])->sum('saldo'))}}" id="flexCheckDefault" name="saldo">
                                        <label class="form-check-label" for="flexCheckDefault">
                                          Gunakan saldo Rp. {{number_format((\App\Models\Saldo::where(['user_id'=>Auth::user()->id, 'type'=>'masuk'])->sum('saldo'))-(\App\Models\Saldo::where(['user_id'=>Auth::user()->id, 'type'=>'keluar'])->sum('saldo')), 0, ',','.')}},-
                                        </label>
                                      </div>
                                </div>

                                

                            </div>
                            @endif
                            <div class="row">
                                <button class="btn btn-primary" type="submit">Checkout</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extraJs')
<script>
    jadwalJemput = $('#jadwalPenjemputan')
    jadwalJemput.hide()
    function changePenjemputan(){
        jemput = $('#jemput').val()
        if(jemput=='Antar Jemput'){
            jadwalJemput.show();
        }else{
            jadwalJemput.hide();  
            $('#jadwal').val('')  
        }
    }
</script>
@endsection
