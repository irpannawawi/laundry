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
                            <a href="{{ route('cart') }}" class="nav-link link-dark">
                                <i class="fa fa-shopping-cart"></i>
                                Keranjang
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('transaction') }}" class="nav-link active">
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
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-sm table-striped table-responsive small">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th nowrap>Order Id</th>
                                    <th>Tanggal</th>
                                    <th nowrap>Layanan</th>
                                    <th>Status Transaksi</th>
                                    <th>Status Pembayaran</th>
                                    <th nowrap>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $n = 1;
                                @endphp
                                @foreach ($transaction_list as $tr)
                                @if ($tr->transaction_status!='finish')
                                    <tr>
                                        <td>{{ $n++ }}</td>
                                        <td>ORD{{ $tr->id_transaction }}</td>
                                        <td>{{ $tr->created_at }}</td>
                                        <td>
                                            <ol>
                                                @foreach ($tr->items as $tri)
                                                    <li>{{ $tri->product_name }}
                                                        @if ($tri->product_name == 'Pakaian Harian')
                                                            <small style="font-size: 12px">(Rp.
                                                                {{ number_format($tri->price, 0, ',', '.') }},-x{{ $tri->berat }}Kg)</small>
                                                        @else
                                                            <small style="font-size: 12px">(Rp.
                                                                {{ number_format($tri->price, 0, ',', '.') }},-)</small>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </td>
                                        <td>
                                            @if ($tr->jadwal_jemput != null && $tr->jadwal_antar == null && $tr->transaction_status == 'ordered')
                                                @if ($tr->payment->payment_type == 'COD' || $tr->payment->status == 'Paid')
                                                    <b>{{ $tr->jadwal_jemput->status }},</b> <small>Pakaian akan dijemput
                                                        pada
                                                        {{ $tr->jadwal_jemput->tanggal }} pukul
                                                        {{ $tr->jadwal_jemput->jam }}
                                                        WIB</small>
                                                @else
                                                    Menunggu pembayaran
                                                @endif
                                            @else
                                                @if ($tr->transaction_status == 'ordered')
                                                    Menunggu Pakaian diantarkan ke toko
                                                @elseif ($tr->transaction_status == 'accepted')
                                                    Pesanan telah diterima oleh toko dan akan segera diproses
                                                @elseif ($tr->transaction_status == 'proccess' && $tr->jadwal_antar == null)
                                                    Pesanan dalam proses oleh toko
                                                @elseif ($tr->transaction_status == 'shipment' && $tr->jadwal_antar != null)
                                                    Pesanan akan diantar oleh toko pada tanggal
                                                    {{ $tr->jadwal_antar->tanggal }} Pukul {{ $tr->jadwal_antar->jam }}
                                                    WIB
                                                @elseif ($tr->transaction_status == 'shipment' && $tr->jadwal_antar == null)
                                                    Pesanan siap untuk diambil, silahkan kunjungi toko untuk mengambil
                                                    pesanan
                                                    anda.
                                                @elseif ($tr->transaction_status == 'canceled')
                                                    <span class="text-danger">Pesanan anda dibatalkan</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if ($tr->transaction_status != 'canceled')
                                                {{ $tr->payment->status == 'Paid' ? 'Lunas' : $tr->payment->status }}({{ $tr->payment->payment_type }})
                                            @endif
                                            <x-badge-discount :discount="$tr->payment->with_discount"/>
                                            <x-badge-saldo :saldo="$tr->payment->with_saldo"/>
                                        </td>
                                        <td nowrap>
                                            Rp. {{ number_format(($tr->payment->price)-($tr->payment->with_saldo + $tr->payment->with_discount), 0, ',', '.') }},-
                                        </td>
                                        <td>
                                            @if (($tr->payment->payment_type != 'COD' && $tr->payment->status != 'Paid') && (($tr->payment->price) - ($tr->payment->with_saldo+$tr->payment->with_discount)) >0)
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"
                                                    onclick="fill_id({{ $tr->id_transaction }})">Bayar</button>
                                            @endif

                                            @if ($tr->transaction_status == 'shipment' && $tr->jadwal_antar == null)
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ route('confirmShipment', ['id' => $tr->id_transaction]) }}"
                                                    onclick="fill_id({{ $tr->id_transaction }})">Konfirmasi</a>
                                            @endif
                                        </td>
                                    </tr>
                                    
                                @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL --}}

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload bukti pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('addPaymentInfo') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <p>Silahkan melakukan transfer sejumlah yang tertera dalam aplikasi ke nomor Rekening <b>BCA
                                10020281 An. NAYA LAUNDRY</b> kemudian upload bukti transfer di bawah.</p>
                        <div class="form-group">
                            <input type="file" name="bukti" id="bukti" class="form-control">
                            <input type="hidden" id="id_transaction" name="id_transaction">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary from-prevent-multiple-submits">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function fill_id(id) {
            document.getElementById('id_transaction').value = id
        }
    </script>
@endsection
