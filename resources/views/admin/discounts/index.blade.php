@extends('layouts.app')
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Diskon</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active"> </li>
                </ol>
            </div>
        </div>
    </div>
    @if (session('success'))
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ session('success') }}</p>
    @endif
    <div class="row">
        <div class="card border-top">
            <div class="card-header">
                <h5 class="float-start">Data Diskon</h5>
                <button class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addModal"><i
                    class="fa fa-plus"></i> Tambah data</button>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Diskon</th>
                                <th>Keterangan</th>
                                <th>Tipe/produk</th>
                                <th>Nominal</th>
                                @if(Auth::user()->role == 'admin')
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $n = 1;
                            @endphp
                            @foreach ($discounts as $discount)
                                <tr>
                                    <td>{{ $n++ }}</td>
                                    <td>{{ $discount->discount_code }}</td>
                                    <td>{{ $discount->discount_name }}</td>
                                    <td>
                                        @if($discount->discount_type=='all')
                                        Semua Produk
                                        @else
                                        {{$discount->produk->product_name}}
                                        @endif
                                    </td>
                                    <td>Rp. {{ number_format($discount->total_discount) }},-</td>
                                    @if(Auth::user()->role == 'admin')
                                    <td>                                        
                                        <div class="btn-group">
                                            <a href="{{route('discounts.delete', ['id'=>$discount->id_discount])}}" onclick="return confirm('Hapus diskon?')" class="btn btn-danger">Hapus</a>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- add Modals --}}

    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('discounts.create') }}">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="discount_code">Kode Diskon</label>
                            <input type="text" class="form-control" name="discount_code" autocomplete="off" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="discount_name">Keterangan</label>
                            <input type="text" class="form-control" name="discount_name" autocomplete="off" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="discount_type">Jenis diskon</label>
                            <select class="form-control"  name="discount_type" onchange="ganti_jenis()" id="discount_type">
                                <option value="all">Semua Produk</option>
                                <option value="item">Produk Tertentu</option>
                            </select>
                        </div>

                        <div class="form-group mb-2" id="produk_pilihan" style="display: none">
                            <label for="product_selected">Produk</label>
                            <select name="product_selected" id="product_selected" class="form-control">
                                <option disabled selected>Pilih produk</option>
                                @foreach ($product_list as $product)
                                    <option value="{{$product->id_product}}">{{$product->product_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label for="total_discount">Nominal Diskon</label>
                            <input type="number" class="form-control" name="total_discount" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    
@endsection
@section('scripts')
<script>
    document.getElementById("formDelete").addEventListener("submit", function(event){
        event.preventDefault()
        if(confirm('Hapus data?')){
            document.getElementById("formDelete").submit()
        }
    });

    function ganti_jenis()
    {
        tipe = $('#discount_type').val()
        if(tipe == 'all')
        {
            $('#produk_pilihan').hide()
            $('#product_selected').val('')
        }else{
            $('#produk_pilihan').show()
        }
    }
</script>
@endsection
