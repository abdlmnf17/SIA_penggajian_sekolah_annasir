@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">Update Data Akun</div>

                    <div class="card-body bg-dark text-white">
                        <form method="POST" action="{{ route('akun.update', $akun->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="nama_akun" class="col-md-4 col-form-label text-md-end">Nama Akun</label>

                                <div class="col-md-6">
                                    <input id="nama_akun" type="text"
                                        class="form-control @error('nama_akun') is-invalid @enderror" name="nama_akun"
                                        value="{{ $akun->nama_akun }}" required autocomplete="nama_akun" autofocus>

                                    @error('nama_akun')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="jenis_akun" class="col-md-4 col-form-label text-md-end">Jenis Akun</label>

                                <div class="col-md-6">
                                    <input id="jenis_akun" type="text"
                                        class="form-control @error('jenis_akun') is-invalid @enderror"
                                        name="jenis_akun" value="{{ $akun->jenis_akun }}" required
                                        autocomplete="jenis_akun">

                                    @error('jenis_akun')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-warning">
                                        Perbarui
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
