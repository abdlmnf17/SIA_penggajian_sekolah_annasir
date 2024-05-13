@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center text-white">
            <div class="col-lg-10">
                <div class="card bg-dark text-white">
                    <h4 class="card-header bg-dark">Edit Karyawan</h4>
                    <div class="card-body">
                        <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" value="{{ $karyawan->nama_karyawan }}" required>
                                        @error('nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                            id="nik" name="nik" value="{{ $karyawan->nik }}" required>
                                        @error('nik')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="ttl">Tanggal Lahir</label>
                                        <input type="date" class="form-control @error('ttl') is-invalid @enderror"
                                            id="ttl" name="ttl" value="{{ $karyawan->tanggal_lahir }}" required>
                                        @error('ttl')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="no_telepon">No Telepon</label>
                                        <input type="number"
                                            class="form-control @error('no_telepon') is-invalid @enderror"
                                            id="no_telepon" name="no_telepon" value="{{ $karyawan->no_telepon }}"
                                            required>
                                        @error('no_telepon')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="jabatan">Jabatan</label>
                                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                            id="jabatan" name="jabatan" value="{{ $karyawan->jabatan }}" required>
                                        @error('jabatan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                            id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L" {{ $guru->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="P" {{ $guru->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}

                                    <div class="form-group">
                                        <label for="studi">Bidang Studi</label>
                                        <input type="text"
                                            class="form-control @error('studi') is-invalid @enderror" id="studi"
                                            name="studi" value="{{ $karyawan->bidang_studi }}" required>
                                        @error('studi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tgs">Tugas Tambahan</label>
                                        <input type="text"
                                            class="form-control @error('tgs') is-invalid @enderror" id="tgs"
                                            name="tgs" value="{{ $karyawan->tugas_tambahan }}" required>
                                        @error('tgs')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>



                                </div>


                                <div class="col-lg-4">
                                    <div class="form-group">

                                        @if ($karyawan->photo)
                                            <label for="photo">Foto Profil</label><br />

                                            <img id="profile_photo_preview"
                                                src="{{ asset('storage/' . $karyawan->photo) }}" alt="Profile Photo"
                                                style="max-width: 150px;">
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <input type="file"
                                            class="form-control-file @error('profile_photo') is-invalid @enderror"
                                            id="profile_photo" name="profile_photo" accept="image/*"
                                            onchange="previewImage(event)">
                                        @error('profile_photo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <!-- Menampilkan preview foto baru -->
                                        <img id="preview" src="#" alt="Preview"
                                            style="max-width: 150px; margin-top: 10px; display: none;">
                                    </div>
                                </div>


                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-warning">Simpan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
