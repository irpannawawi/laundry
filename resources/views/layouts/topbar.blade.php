<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box ">
                <a href="{{route('dashboard')}}" class="mt-2 logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{url('assets')}}/images/logo1.png" alt="" style="height:25px;" > <h4>Naya Laundry</h4>
                    </span>
                    <span class="logo-lg">
                        <img src="{{url('assets')}}/images/logo1.png" alt="" style="height:25px; width: 25px"> <h4>Naya Laundry</h4>
                    </span>
                </a>

                <a href="{{route('dashboard')}}" class="mt-2 logo logo-light">
                    <span class="logo-sm">
                        <img src="{{url('assets')}}/images/logo1.png" alt="" style="width: 30px; margin: 0px auto;"> <h4>Naya Laundry</h4>
                    </span>
                    <span class="logo-lg">
                        <img src="{{url('assets')}}/images/logo1.png" alt="" style="width:45px; margin: 0px auto;"> <h4>Naya Laundry</h4>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-menu"></i>
            </button>
        </div>

        <div class="d-flex">



            <div class="dropdown d-none d-lg-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen"></i>
                </button>
            </div>



            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{url('storage')}}/avatar/avatar.png"
                        alt="Header Avatar">
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger" type="submit"><i class="bx bx-power-off font-size-17 align-middle me-1 text-danger"></i> Logout</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>