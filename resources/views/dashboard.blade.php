@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
            @endif
            <br/>
            
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fas fa-times"></i>  <strong>Gagal!</strong>  {{ session('error') }}...
            </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">

                    Kamu sedang login sebagai  {{ Auth::user()->name }}.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
