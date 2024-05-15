@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">Update Data Honor Mengajar </div>

                    <div class="card-body bg-dark text-white">
                        <form method="POST" action="{{ route('honormengajar.update', $honormengajar->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="jam_mengajar" class="col-md-4 col-form-label text-md-end">Jam Mengajar</label>

                                <div class="col-md-6">
                                    <input id="jam_mengajar" type="text"
                                        class="form-control @error('jam_mengajar') is-invalid @enderror" name="jam_mengajar"
                                        value="{{ $honormengajar->jam_mengajar }}">

                                    @error('jam_mengajar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="jumlah_mengajar" class="col-md-4 col-form-label text-md-end">Jumlah Honor</label>

                                <div class="col-md-6">
                                    <input id="jumlah_mengajar" type="number"
                                        class="form-control @error('jumlah_mengajar') is-invalid @enderror"
                                        name="jumlah_mengajar" value="{{ $honormengajar->jumlah_mengajar }}">

                                    @error('jumlah_mengajar')
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
