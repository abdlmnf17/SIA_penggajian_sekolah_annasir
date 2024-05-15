@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">Update Data Tunjangan </div>

                    <div class="card-body bg-dark text-white">
                        <form method="POST" action="{{ route('tunjangan.update', $tunjangan->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Nama</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ $tunjangan->nama_tunjangan }}">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="jumlah_tunjangan" class="col-md-4 col-form-label text-md-end">Jumlah
                                    Tunjangan</label>

                                <div class="col-md-6">
                                    <input id="jumlah_tunjangan" type="number"
                                        class="form-control @error('jumlah_tunjangan') is-invalid @enderror"
                                        name="jumlah_tunjangan" value="{{ $tunjangan->jumlah_tunjangan }}">

                                    @error('jumlah_tunjangan')
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
