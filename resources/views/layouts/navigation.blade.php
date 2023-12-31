<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-title">Master Data</li>

                <li>
                    <a href="{{route('users')}}" class=" waves-effect">
                        <i class="fa fa-users"></i>
                        <span>Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('produk')}}" class=" waves-effect">
                        <i class="fa fa-box"></i>
                        <span>Produk</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{route('discounts')}}" class=" waves-effect">
                        <i class="fa fa-percent"></i>
                        <span>Diskon</span>
                    </a>
                </li>
                <li class="menu-title">Transaksi</li>

                
                <li>
                    <a href="{{route('order')}}" class=" waves-effect">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Pesanan Baru</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{route('proccess')}}" class=" waves-effect">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Sedang Diproses</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{route('transaction_finished')}}" class=" waves-effect">
                        <i class="fa fa-check"></i>
                        <span>Selesai</span>
                    </a>
                </li>

                <li class="menu-title">Laporan</li>

                <li>
                    <a href="{{route('laporan')}}" class=" waves-effect">
                        <i class="fa fa-print"></i>
                        <span>Cetak Laporan</span>
                    </a>
                </li>
                <li class="menu-title">Lain-lain</li>

                <li>
                    <a href="{{url('assets/documents/')}}/panduan_admin.pdf" class=" waves-effect">
                        <i class="fa fa-book"></i>
                        <span>Panduan Penggunaan</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>