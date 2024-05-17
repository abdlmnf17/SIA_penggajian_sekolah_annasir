@extends('layouts.app')

@section('content')
    <div class="col-lg-11 mb-10 mx-auto">
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
                <a href="#" class="btn btn-warning float-right" data-toggle="modal" data-target="#addAkunModal">
                    <i class="fas fa-plus-circle"></i> Tambah Akun
                </a>
                <h4 class="m-15 font-weight-bold">{{ __('Daftar Akun') }}</h4>
            </div>
            <div class="card-body bg-dark">
                <table id="dataTable" class="table table-bordered text-white" cellspacing="1"><br />
                    <thead>
                        <tr align="center">
                            <th style="width: 5%">#</th>
                            <th style="width: 10%">Kode Akun</th>
                            <th style="width: 20%">Nama Akun</th>
                            <th style="width: 20%">Jenis Akun</th>
                            <th style="width: 20%">Jumlah Akun</th>
                            <th style="width: 205%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($akun as $index => $akunItem)
                            <tr align="center">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $akunItem->kode_akun }}</td>
                                <td>{{ $akunItem->nama_akun }}</td>
                                <td>{{ $akunItem->jenis_akun }}</td>
                                <td>Rp. {{ number_format($akunItem->jumlah_akun, 2, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('akun.edit', $akunItem->id) }}" class="btn btn-sm btn-info">
                                        <i class="far fa-edit"></i> Edit
                                    </a>
                                    <!-- Tombol Hapus -->
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#confirmDeleteModal{{ $akunItem->id }}">
                                        <i class="far fa-trash-alt"></i> Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade text-dark" id="confirmDeleteModal{{ $akunItem->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form method="post" action="{{ route('akun.destroy', $akunItem->id) }}">
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
                                                <p>Apakah Anda yakin ingin menghapus akun ini?</p>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Akun -->
    <div class="modal fade text-dark" id="addAkunModal" tabindex="-1" role="dialog"
        aria-labelledby="addAkunModalLabel" aria-hidden="true">
        <!-- Isi Modal Tambah  -->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('akun.store') }}">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAkunModalLabel">Tambah Akun Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="kode_akun" class="col-md-4 col-form-label text-md-end">Kode Akun</label>
                            <div class="col-md-6">
                                <input id="kode_akun" type="number"
                                    class="form-control @error('kode_akun') is-invalid @enderror" name="kode_akun"
                                    value="{{ old('kode_akun') }}" required autocomplete="kode_akun" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama_akun" class="col-md-4 col-form-label text-md-end">Nama Akun</label>
                            <div class="col-md-6">
                                <input id="nama_akun" type="text"
                                    class="form-control @error('nama_akun') is-invalid @enderror" name="nama_akun"
                                    value="{{ old('nama_akun') }}" required autocomplete="nama_akun" autofocus>
                            </div>
                        </div>





                        <div class="row mb-3">
                            <label for="jenis_akun" class="col-md-4 col-form-label text-md-end">Jenis Akun</label>
                            <div class="col-md-6">
                                <input id="jenis_akun" type="text"
                                    class="form-control @error('jenis_akun') is-invalid @enderror"
                                    name="jenis_akun" value="{{ old('jenis_akun') }}" required
                                    autocomplete="jenis_akun">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jumlah_akun" class="col-md-4 col-form-label text-md-end">Jumlah Akun</label>
                            <div class="col-md-6">
                                <input id="jumlah_akun" type="number"
                                    class="form-control @error('jumlah_akun') is-invalid @enderror"
                                    name="jumlah_akun" value="{{ old('jumlah_akun') }}" required
                                    autocomplete="jumlah_akun">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
