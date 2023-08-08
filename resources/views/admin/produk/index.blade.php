@extends('layouts.app')
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Produk</h6>
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
                <h5 class="float-start">Data Produk</h5>
                @if(Auth::user()->role == 'admin')
                <button class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addModal"><i
                    class="fa fa-plus"></i> Tambah data</button>
                    @endif
            </div>
            <div class="card-body">
                <section style="background-color: #eee;">
                    <div class="container py-5">
                        <div class="row justify-content-center">
                    @foreach ($produks as $produk)
                            <div class="col-md-12 col-xl-10">
                                <div class="card shadow-0 border rounded-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                                <div class="bg-image">
                                                    <img src="{{Storage::url('produk/'.$produk->picture)}}"
                                                        class="w-100" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <h5>{{$produk->product_name}}</h5>
                                                
                                            </div>
                                            <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                                <div class="d-flex flex-row align-items-center mb-1">
                                                    <h4 class="mb-1 me-1">Rp. {{number_format($produk->price, 0, ',', '.')}};-</h4>
                                                </div>
                                                <div class="d-flex flex-column mt-4">
                                                    @if(Auth::user()->role == 'admin')
                                                    <a href="{{route('produk.edit', ['id'=>$produk->id_product])}}" class="btn btn-primary btn-sm" type="button">Edit</a>
                                                    <form action="{{route('produk.delete', ['id'=>$produk->id_product])}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-outline-danger form-control btn-sm mt-2"  onclick="return confirm('Hapus produk?')" type="submit">
                                                            Delete
                                                        </button>
                                                        @endif
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>
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
                    <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="product_name">Nama Produk</label>
                            <input type="text" class="form-control" name="product_name" autocomplete="off" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="price">Harga</label>
                            <input type="number" class="form-control" placeholder="Rp. ...." name="price"
                                autocomplete="off" required>
                        </div>
                        
                        <div class="form-group mb-2">
                            <label for="picture">Foto</label>
                            <input type="file" class="form-control" name="picture"
                                autocomplete="off" required>
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
        document.getElementById("formDelete").addEventListener("submit", function(event) {
            event.preventDefault()
            if (confirm('Hapus data?')) {
                document.getElementById("formDelete").submit()
            }
        });
    </script>
@endsection
