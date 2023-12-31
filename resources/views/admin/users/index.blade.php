@extends('layouts.app')
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Pengguna</h6>
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
                <h5 class="float-start">Data Pengguna</h5>
                <button class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addModal"><i
                    class="fa fa-user-plus"></i> Tambah data</button>
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <form action="{{route('users')}}" method="GET">
                            @csrf
                            <div class="input-group col-3 pt-3 pb-3">
                                <input type="search" name="keyword" id="keyword" class="form-control form-control-sm">
                                <input type="submit" value="Cari" class="btn btn-secondary">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>userid</th>
                                <th>Membership</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $n = 1;
                            @endphp
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $n++ }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ strtoupper($user->role) }}</td>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        @if ($user->is_membership==1)
                                            <span class="badge bg-success"><i class="fa fa-crown"></i> Member User</span>
                                            @else
                                            <span class="badge bg-danger">Non Member</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form id="formDelete" method="post" action="{{route('users.delete')}}">
                                            @csrf
                                            @method('delete')
                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-warning" href="{{route('users.edit', ['id'=>$user->id])}}" title="Edit"><i class="fa fa-edit"></i></a>
                                                <input type="hidden" value="{{$user->id}}" name="id">
                                                <button type="submit" title="Hapus" class="btn btn-sm btn-danger" href="#"><i class="fa fa-trash"></i></button>
                                            </div>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-6 float-end">
                            {{ $users->links() }}
                        </div>
                    </div>
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
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="name">Username</label>
                            <input type="text" class="form-control" name="name" autocomplete="off" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="full_name">Nama Lengkap</label>
                            <input type="text" class="form-control" name="full_name" autocomplete="off" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" placeholder="example@domain.com" name="email"
                                autocomplete="off" required>
                        </div>

                        <div class="form-group mb-2">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="admin">ADMIN</option>
                                <option value="owner">OWNER</option>
                                <option value="customer">CUSTOMER</option>
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" required>
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

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Tambah data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('users.update') }}">
                        @csrf
                        @method('put')
                        <div class="form-group mb-2">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" name="name" id="editName" autocomplete="off">
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="editEmail" placeholder="example@domain.com" name="email"
                                autocomplete="off">
                        </div>

                        <div class="form-group mb-2">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="admin">ADMIN</option>
                                <option value="pengguna">PENGGUNA</option>
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
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
</script>
@endsection
