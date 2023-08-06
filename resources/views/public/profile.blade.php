@extends('layouts.public_layout')
@section('manualCss')
    <style>
        .form-control {
            border: 1px solid #cfd1d8;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            background: #ffffff;
            color: #2e323c;
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="container mt-5 mb-3">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil</strong> {{ Session::get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
        @endif
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item text-dark">
                            <a href="{{route('publicProfile')}}" class="nav-link active" aria-current="page">
                                <i class="fa fa-user"></i>
                                Profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('cart')}}" class="nav-link link-dark">
                                <i class="fa fa-shopping-cart"></i>
                                Keranjang
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('transaction')}}" class="nav-link link-dark">
                                <i class="fa fa-table"></i>
                                Transaksi
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('history')}}" class="nav-link link-dark">
                                <i class="fa fa-history"></i>
                                History
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <form action="{{ route('publicProfileUpdate', ['id' => Auth::user()->id]) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mb-2 text-primary">Profil</h6>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="name">Nama pengguna</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            autocomplete="off" value="{{ $profile->name }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="full_name">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name"
                                            value="{{ $profile->full_name }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $profile->email }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="phone">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="phone"
                                            placeholder="Enter phone number" name="phone" value="{{ $profile->phone }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mt-3 mb-2 text-primary">Alamat</h6>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea name="address" class="form-control" id="address" cols="30" rows="10">{{ $profile->address }}</textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mt-3 mb-2 text-primary">Ganti Password</h6>
                                </div>
                                <div class="col-md-6 col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="old_password">Password Lama</label>
                                        <input type="password" class="form-control" id="old_password" name="old_password">
                                    </div>
                                </div>
                                <div></div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="new_password">Password Baru</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password">
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="confirm_password">Password Lama</label>
                                        <input type="password" class="form-control" id="confirm_password"
                                            name="confirm_password">
                                    </div>
                                </div>
                            </div>

                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        <button type="reset" id="submit" name="submit"
                                            class="btn btn-secondary">Cancel</button>
                                        <button type="submit" id="submit" name="submit"
                                            class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
