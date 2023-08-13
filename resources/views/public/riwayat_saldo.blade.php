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
                            <a href="{{ route('transaction') }}" class="nav-link link-dark">
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
                            <a href="{{route('riwayatSaldo')}}" class="nav-link active">
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
                                    <th nowrap>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th nowrap>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no =1;
                                @endphp
                                @foreach ($riwayat as $saldo)
                                    
                                <tr>
                                    <td class="text-center">{{$no++}}</td>
                                    <td>{{$saldo->created_at}}</td>
                                    <td>{{$saldo->ket}}</td>
                                    <td class="text-{{$saldo->type=='masuk'?'success':'danger'}}">Rp. {{number_format($saldo->saldo, 0, ',', '.')}},-</td>
                                </tr>
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
                        <button type="submit" class="btn btn-primary">Kirim</button>
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
