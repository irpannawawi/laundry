@extends('layouts.app')
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Produk</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to HPW05 Dashboard</li>
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
                <h5 class="float-start">Data Produk</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('produk.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group mb-2">
                        <label for="product_name">Nama Produk</label>
                        <input type="text" class="form-control" value="{{$produk->product_name}}" name="product_name" autocomplete="off" required>
                        <input type="hidden" value="{{$produk->id_product}}" name="id_product" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" name="description" rows="6" required>{{$produk->descriptions}}</textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label for="price">Harga</label>
                        <input value="{{$produk->price}}" type="number" class="form-control" placeholder="Rp. ...." name="price" autocomplete="off"
                            required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="picture">Foto</label>
                        <input type="file" class="form-control" name="picture" autocomplete="off">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{url('produk')}}" class="btn btn-secondary" >Close</a>
            </form>
        </div>
    </div>
    </div>
@endsection
