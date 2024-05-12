{{-- @extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Daftar User') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Kamu sedang login sebagai  {{ Auth::user()->name }}.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


@extends('layouts.app')

@section('content')
<div class="col-lg-9 mb-10 mx-auto ">
                <!-- Menampilkan pesan kesuksesan -->
        @if(session('success'))

        <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fas fa-check-circle"></i>  <strong>Sukses!</strong>  {{ session('success') }}.
                  </div>

                @endif

                @if(session('error'))
                <div class="alert alert-error" role="alert">
                    {{ session('error') }}
                </div>
                @endif

            @if ($errors->any())

                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fas fa-times"></i>  <strong>Gagal ditambahkan!</strong> 
                    <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach

                </ul>
            </div>

            @endif


                <br/>
    <!-- Project Card Example -->
    <div class="card shadow mb-4 text-white">
        <div class="card-header py-3 bg-dark">

            <a href="#" class="btn btn-warning float-right" data-toggle="modal" data-target="#addUserModal">
                <i class="fas fa-plus-circle"></i> Tambah User
            </a>
            {{-- {{ __('Daftar User') }} --}}
            <h4 class="m-15 font-weight-bold">{{ __('Daftar User') }}</h4>
        </div>
        <div class="card-body bg-dark">


            <table id="dataTable" class="table table-bordered text-white" cellspacing="1"><br/>
                <thead>
                    <tr align="center">
                        <th style="width: 5%">#</th>
                        <th style="width: 20%">Nama User</th>
                        <th style="width: 20%">Email</th>
                        <th style="width: 15%">Role</th>
                        <th style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $index => $userItem)
                    <tr align="center">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $userItem->name }}</td>
                        <td>{{ $userItem->email }}</td>
                        <td>{{ $userItem->role }}</td>
                        <td>
                            <a href="{{ route('user.edit', $userItem->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <!-- Tombol Hapus -->
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{ $userItem->id }}">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Konfirmasi Hapus -->
                    <div class="modal fade text-dark" id="confirmDeleteModal{{ $userItem->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="post" action="{{ route('user.destroy', $userItem->id) }}">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus pengguna ini?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                    <!-- Modal Tambah User -->
<div class="modal fade text-dark" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <!-- Isi Modal Tambah User -->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('user.store') }}">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Daftar User Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nama</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                {{-- @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Alamat Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                {{-- @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">Role</label>
                            <div class="col-md-6">
                                <select id="role" class="form-select @error('role') is-invalid @enderror" name="role" required autocomplete="role" autofocus>

                                    <option value ="">
                                        ------- Pilih hak akses -------
                                    </option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                                {{-- @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                        </div>




                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                {{-- @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Konfirmasi</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Daftar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


</div>


                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
