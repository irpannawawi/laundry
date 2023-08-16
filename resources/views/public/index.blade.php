@extends('layouts.public_layout')

@section('content')

<!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <img src="assets/images/gallery/brand1.png" alt="brand1" class="img-fluid">
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <img src="assets/images/gallery/brand2.png" alt="brand1" class="img-fluid">
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <img src="assets/images/gallery/brand3.png" alt="brand1" class="img-fluid">
                </div>
            </div>
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <!-- End Banner Hero -->

        <!-- Start Featured Product -->
        <section class="grad" id="layanan">
            <div class="container py-5">
                <div class="row text-center py-3">
                    <div class="col-lg-6 m-auto">
                        <h1 class="h1">Layanan</h1>
                        <p>
                            Berbagai layanan yang ada di Naya Laundy
                        </p>
                    </div>
                </div>
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="{{Storage::url('produk/'.$product->picture)}}" class="card-img-top" height="200" width="200" alt="...">
                            <div class="card-body">
                                <ul class="list-unstyled d-flex justify-content-between">
                                    <li class=" text-right">Rp. {{number_format($product->price, 0, ',','.')}}{{$product->product_name == 'Pakaian Harian'?'/Kg':''}}</li>
                                </ul>
                                <p href="#" class="h2 text-decoration-none text-dark">{{$product->product_name}}</p>
                                <div class="col-12">
                                    @if (Auth::user()!=null)
                                    <a href="{{route('addToCart', ['id_product'=>$product->id_product])}}" class="btn  btn-primary float-end">Add to cart</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- End Featured Product --> 
        @include('components.modal_promo');
@endsection