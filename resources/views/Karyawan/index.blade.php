@extends('layouts.app')

@section('content')
    <div class="col-lg-9 mb-10 mx-auto ">
        <!-- Menampilkan pesan kesuksesan -->
        @if (session('success'))
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fas fa-check-circle"></i> <strong>Sukses!</strong> {{ session('success') }}.
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fas fa-times"></i> <strong>Gagal ditambahkan!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>
            </div>
        @endif


        <br />
        <!-- Project Card Example -->
        <div class="card shadow mb-4 text-white">
            <div class="card-header py-3 bg-dark">
                <a href="{{ route('karyawan.create') }}" class="btn btn-warning float-right">
                    <i class="fas fa-plus-circle"></i> Tambah
                </a>
                <h4 class="m-15 font-weight-bold">{{ __('Daftar Karyawan') }}</h4>
            </div>

            <div class="card-body bg-dark">

                <table id="dataTable" class="table table-bordered text-white" cellspacing="1"><br />
                    <thead>
                        <tr align="center">
                            <th style="width: 10%">#</th>
                            <th style="width: 20%">Nama</th>
                            <th style="width: 15%">Bidang Studi</th>
                            <th style="width: 20%">Jabatan</th>
                            <th style="width: 20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawan as $index => $userItem)
                            <tr style="text-align: center">
                                <td><img src="{{ asset('storage/' . $userItem->photo) }}" alt="Profile Photo"
                                        style="max-width: 50px; display: block; margin: 0 auto;">
                                </td>
                                <td>{{ $userItem->nama_karyawan }}</td>
                                <td>{{ $userItem->bidang_studi }}</td>
                                <td>{{ $userItem->jabatan }}</td>
                                <td>
                                    <a href="{{ route('karyawan.show', $userItem->id) }}" class="btn btn-sm btn-primary">
                                        <i class="far fa-id-card"></i>
                                    </a>
                                    <a href="{{ route('karyawan.edit', $userItem->id) }}" class="btn btn-sm btn-info">
                                        <i class="far fa-edit"></i>
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#confirmDeleteModal{{ $userItem->id }}">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade text-dark" id="confirmDeleteModal{{ $userItem->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form method="post" action="{{ route('karyawan.destroy', $userItem->id) }}">
                                            @csrf
                                            @method('delete')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus karyawan ini?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
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
@endsection
