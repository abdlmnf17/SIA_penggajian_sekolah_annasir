@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card text-white bg-dark">
                    <div class="card-header bg-dark">Detail Karyawan </div>
                    <br />
                    @if ($karyawan->photo)
                        <div class="form-group">
                            <label for="photo"></label><br>
                            <div style="display: flex; justify-content: center; align-items: center; height: 30vh;">
                                <img src="{{ asset('storage/' . $karyawan->photo) }}" alt="Profile Photo"
                                    style="max-width: 150px;">
                            </div>


                        </div>
                    @endif

                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control" id="nama" value="{{ $karyawan->nama_karyawan }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="ttl">Tanggal Lahir:</label>
                            <input type="text" class="form-control" id="ttl" value="{{ $karyawan->tanggal_lahir }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="nik">NIK:</label>
                            <input type="text" class="form-control" id="nip" value="{{ $karyawan->nik }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="jabatan">Jabatan:</label>
                            <input type="text" class="form-control" id="jabatan" value="{{ $karyawan->jabatan }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="studi">Bidang Studi:</label>
                            <input type="text" class="form-control" id="studi" value="{{ $karyawan->bidang_studi }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="tugas_tambahan">Tugas Tambahan:</label>
                            <input type="text" class="form-control" id="tugas_tambahan"
                                value="{{ $karyawan->tugas_tambahan }}" readonly>
                        </div>


                        <a href="/karyawan" class="btn btn-sm btn-warning">
                           Kembali
                        </a>
                        <a href="{{ route('karyawan.edit', $karyawan->id) }}" class="btn btn-sm btn-info">
                             Edit
                        </a>



                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
