@extends('layouts.public_layout')

@section('content')

<!-- Start Banner Hero -->
<section class="bg-info py-5">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-md-8 text-white">
                <h1>Tentang kami</h1>
                <p>
                    Naya Laundry milik Ny. Titin Sumiatin melayani jasa laundry satuan, kiloan dan jasa lainnya yang terpercaya, berlokasi di Perumahan Puri Kosambi 1 Blok PP No 15. silahkan <a class="link-dark" href="https://wa.me/6281293689886">hubungi  </a> untuk informasi lebih lanjut
                </p>
            </div>
            <div class="col-md-4">
                <img class="img-fluid" src="{{url('/')}}/assets/images/logo1.png" alt="About Hero">
            </div>
        </div>
    </div>
</section>
    <!-- End Banner Hero -->


@endsection