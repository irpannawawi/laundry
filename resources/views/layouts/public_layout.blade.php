<!DOCTYPE html>
<html lang="en">

<head>
    <title>Naya Laundry</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="{{url('assets')}}/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('assets')}}/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('assets')}}/images/favicon-16x16.png">
    <link rel="manifest" href="{{url('assets')}}/images/site.webmanifest">

    <link rel="stylesheet" href="{{url('assets')}}/zayshop/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('assets')}}/zayshop/assets/css/templatemo.css">
    <link rel="stylesheet" href="{{url('assets')}}/zayshop/assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="{{url('assets')}}/zayshop/assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
<style>
    .grad {
    background-image: linear-gradient(75deg, rgb(57, 162, 249), rgb(110, 236, 255), rgb(53, 53, 255));
    }
</style>
@yield('manualCss')
</head>

<body class="grad">

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow bg-light">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="{{url('/')}}/assets/images/logo1.png" alt="" class="d-inline-block align-text-top m-2" height="45"> 
            <a class="navbar-brand text-info logo h3 mt-2 mr-3" href="{{url('/')}}">Naya <small>Laundry</small>
        </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#layanan">Layanan</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="/#panduan">Panduan</a>
                        </li>
                        @if (Auth::user()==null)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('login')}}">Login/Register</a>
                        </li>
                        @endif

                    </ul>
                </div>
                @if (Auth::user()!=null)
                <div class="navbar align-self-center d-flex">
                    
                    <a class="nav-icon position-relative text-decoration-none" href="{{route('cart')}}">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="{{route('publicProfile')}}">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="nav-icon position-relative btn text-decoration-none text-danger" onclick="return confirm('Apakah anda akan keluar dari sesi ini?')" type="submit"><i class="fa fa-sign-in"></i></button>
                    </form>
                </div>
                @endif
            </div>

        </div>
    </nav>
    <!-- Close Header -->




@yield('content')






    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-info border-bottom pb-3 border-light logo">Naya Laundry</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            Perumahan Puri Kosambi 1 Blok PP No 15
                        </li>
                        <li>
                            <i class="fab fa-whatsapp"></i>
                            <a class="text-decoration-none" href="https://wa.me/6281293689886">081293689886</a>
                        </li>
                        <li>
                            <i class="fa fa-user "></i>
                            <a class="text-decoration-none" href="#">Titin Sumiatin</a>
                        </li>
                    </ul>
                </div>



            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2023 Naya Laundry 
                            | Designed by <a rel="sponsored" href="https://templatemo.com" target="_blank">TemplateMo</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="{{url('assets')}}/zayshop/assets/js/jquery-1.11.0.min.js"></script>
    <script src="{{url('assets')}}/zayshop/assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="{{url('assets')}}/zayshop/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('assets')}}/zayshop/assets/js/templatemo.js"></script>
    <script src="{{url('assets')}}/zayshop/assets/js/custom.js"></script>
    @yield('extraJs')
    @if (Session::has('msg'))
            <script>
                alert('{{\Session::get('msg')}}')
            </script>
        @endif
    <!-- End Script -->
</body>

</html>