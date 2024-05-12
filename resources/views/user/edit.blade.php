<!-- resources/views/user/create.blade.php -->

@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">Update Data User </div>

                    <div class="card-body bg-dark text-white">
                        <form method="POST" action="{{ route('user.update', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Nama</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Alamat Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            @if(Auth::user()->role != 'user') {{-- Periksa apakah pengguna yang login bukan sebagai user --}}
<div class="row mb-3">
    <label for="role" class="col-md-4 col-form-label text-md-end">Role</label>

    <div class="col-md-6">
        <select id="role" class="form-select @error('role') is-invalid @enderror" name="role" required autocomplete="role" autofocus>
            <option value="{{ $user->role }}">
                Role sekarang: {{ $user->role }}
            </option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
        </select>
    </div>
</div>
@else
<input type="hidden" name="role" value="user">
@endif



<div class="row mb-3">
    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password', $user->password) }}">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Konfirmasi Password</label>

    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation', $user->password) }}">
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
