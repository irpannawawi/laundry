@extends('layouts.app')
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Pesanan</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active"> </li>
                </ol>
            </div>
        </div>
    </div>
    @if (session('success'))
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
            {{ session('success') }}</p>
    @endif
    <div class="row">
        <div class="card border-top">
            <div class="card-header">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" id="tabPesananBaru" href="#">Pesanan Baru</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="tabPenjemputan" href="#">Jadwal Penjemputan</a>
                    </li>
                  </ul>
            </div>
            <div class="card-body">
                <div id="pagePesananBaru">@include('admin.order.pesanan_baru')</div>
                <div id="pagePenjemputan" style="display: none;">@include('admin.order.jadwal_jemput')</div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        tabPesananBaru = $('#tabPesananBaru')
        tabPenjemputan = $('#tabPenjemputan')
        pagePesananBaru = $('#pagePesananBaru')
        pagePenjemputan = $('#pagePenjemputan')
        
        tabPesananBaru.click(function(){
            tabPesananBaru.addClass('active');
            tabPenjemputan.removeClass('active');
            pagePenjemputan.hide()
            pagePesananBaru.show()
        })
        
        
        tabPenjemputan.click(function(){
            tabPesananBaru.removeClass('active');
            tabPenjemputan.addClass('active');
            pagePesananBaru.hide()
            pagePenjemputan.show()
        })
    </script>
@endsection
