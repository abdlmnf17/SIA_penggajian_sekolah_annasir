@extends('layouts.app')

@section('content')
    <div class="col-lg-9 mb-10 mx-auto">
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
                <a href="#" class="btn btn-warning float-right" data-toggle="modal" data-target="#addPotonganModal">
                    <i class="fas fa-plus-circle"></i> Tambah Potongan
                </a>
                <h4 class="m-15 font-weight-bold">{{ __('Daftar Potongan') }}</h4>
            </div>
            <div class="card-body bg-dark">
                <table id="dataTable" class="table table-bordered text-white" cellspacing="1"><br />
                    <thead>
                        <tr align="center">
                            <th style="width: 5%">#</th>
                            <th style="width: 20%">Nama</th>
                            <th style="width: 20%">Jumlah</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($potongan as $index => $potonganItem)
                            <tr align="center">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $potonganItem->nama_potongan }}</td>
                                <td>Rp. {{ number_format($potonganItem->jumlah_potongan, 2, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('potongan.edit', $potonganItem->id) }}" class="btn btn-sm btn-info">
                                        <i class="far fa-edit"></i> Edit
                                    </a>
                                    <!-- Tombol Hapus -->
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#confirmDeleteModal{{ $potonganItem->id }}">
                                        <i class="far fa-trash-alt"></i> Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade text-dark" id="confirmDeleteModal{{ $potonganItem->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form method="post" action="{{ route('potongan.destroy', $potonganItem->id) }}">
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
                                                <p>Apakah Anda yakin ingin menghapus potongan ini?</p>
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

    <!-- Modal Tambah Potongan -->
    <div class="modal fade text-dark" id="addPotonganModal" tabindex="-1" role="dialog"
        aria-labelledby="addPotonganModalLabel" aria-hidden="true">
        <!-- Isi Modal Tambah  -->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('potongan.store') }}">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPotonganModalLabel">Daftar Potongan Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nama</label>
                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jumlah_potongan" class="col-md-4 col-form-label text-md-end">Jumlah</label>
                            <div class="col-md-6">
                                <input id="jumlah_potongan" type="number"
                                    class="form-control @error('jumlah_potongan') is-invalid @enderror"
                                    name="jumlah_potongan" value="{{ old('jumlah_potongan') }}" required
                                    autocomplete="jumlah_potongan">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="karyawan_id" class="col-md-4 col-form-label text-md-end">Karyawan</label>
                            <div class="col-md-6">
                                <select id="karyawan_id" class="form-control @error('karyawan_id') is-invalid @enderror"
                                    name="karyawan_id" required>
                                    <option value="">Pilih Karyawan</option>
                                    @foreach ($karyawans as $karyawan)
                                        <option value="{{ $karyawan->id }}">{{ $karyawan->nama_karyawan }}
                                            ({{ $karyawan->jabatan }})</option>
                                    @endforeach
                                </select>
                                @error('karyawan_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
