@extends('layouts.app')
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Sedang Diproses</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active"> </li>
                </ol>
            </div>
        </div>
    </div>
    @if (Session::has('msg'))
    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-success">
            {{ Session::get('msg') }}</p>
    @endif
    <div class="row">
        <div class="card border-top">
            <div class="card-header">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" id="tabPesananBaru" href="#">Dalam Proses</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="tabPenjemputan" href="#">Jadwal Pengiriman</a>
                    </li>
                  </ul>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="pagePesananBaru">@include('admin.proccess.pesanan_baru')</div>
                <div class="table-responsive" id="pagePenjemputan" style="display: none;">@include('admin.proccess.jadwal_kirim')</div>
            </div>
        </div>
    </div>

    {{-- modal add jadwal kirim --}}
    <!-- Modal -->
<div class="modal fade" id="pengirimanModal" tabindex="-1" aria-labelledby="pengirimanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pengirimanModalLabel">Jadwalkan pengiriman</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('toShipment')}}" method="POST">
        <div class="modal-body">
            @csrf
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{date('Y-m-d')}}">
                <input type="hidden" name="id_transaction" id="idTrans">
            </div>
            <div class="form-group">
                <label for="jadwal">Jam</label>
                <select name="jam" id="jadwalJam" class="form-control">
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
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Buat  </button>
        </div>
    </form>
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

        function add_shipment(id)
        {
            $('#idTrans').val(id);
        }
    </script>
@endsection
