@extends('layouts.app')
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Laporan</h6>
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
        <div class="card border-top border-2 border-primary border-start">
            <div class="card-header">
                @if (Session::has('msg'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Berhasil</strong> {{Session::get('msg')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link {{$page==1?'active':''}}" aria-current="page" id="tabPesananBaru" href="#">Laporan Keuangan
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{$page==2?'active':''}}" id="tabPenjemputan" href="#">Laporan Penjualan</a>
                    </li>
                  </ul>
            </div>
            <div class="card-body ">
                <div id="pagePesananBaru" class="table-responsive" style="display: {{$page==2?'none':''}}">@include('admin.laporan.keuangan')</div>
                <div id="pagePenjemputan" class="table-responsive" style="display: {{$page==1?'none':''}};">@include('admin.laporan.penjualan')</div>
            </div>
        </div>
    </div>

    {{-- modal bukti pembayaran --}}
    <div class="modal fade" id="infoPayment" tabindex="-1" aria-labelledby="infoPaymentLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="infoPaymentLabel">Bukti pembayaran</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="" alt="" id="imgInfo" class="img img-fluid ">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
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

        function get_payment_info(src)
        {
            $('#imgInfo').attr('src', '{{url("storage/bukti")}}/'+src)
        }
    </script>
@endsection
