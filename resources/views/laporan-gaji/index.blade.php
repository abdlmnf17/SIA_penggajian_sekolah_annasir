@extends('layouts.app')

@section('content')

<div class="col-lg-12 mb-4 mx-auto">
    <div class="card shadow mb-4 text-white">
        <div class="card-header py-3 bg-dark">
            <h4 class="m-15 font-weight-bold">{{ __('Laporan Gaji') }}</h4>
        </div>
        <div class="card-body bg-dark">
            <form action="{{ route('laporan.gaji.generate') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tanggal_mulai">Periode Mulai:</label>
                    <input type="date" name="tanggal_mulai" class="form-control form-control-sm" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_selesai">Periode Selesai:</label>
                    <input type="date" name="tanggal_selesai" class="form-control form-control-sm" required>
                </div>
                <button type="submit" class="btn btn-primary btn-sm mt-2">Tampilkan Laporan</button>
            </form>
            <br />
            <br />



            @isset($gaji)
                <div class="container mt-10">

                    <h4 align="center">Laporan Penggajian <br/>
                        {{ config('app.nama_sekolah', 'Laravel') }}<br />
                       </h4>
                       <h5 align="center">  Periode: {{ $tanggal_mulai }} sampai {{ $tanggal_selesai }}</h5>
                    <table class="table table-bordered text-white">
                        <thead>
                            <tr>
                                <th>Kode Gaji</th>
                                <th>Tanggal Gaji</th>
                                <th>Nama Karyawan</th>
                                <th>Jabatan</th>
                                <th>Studi</th>

                                <th>Total Diterima</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gaji as $item)
                            <tr>
                                <td>{{ $item->kode_gaji }}</td>
                                <td>{{ $item->tanggal_gaji }}</td>
                                <td>{{ $item->karyawan->nama_karyawan }}</td>
                                <td>{{ $item->karyawan->jabatan }}</td>
                                <td>{{ $item->karyawan->bidang_studi }}</td>


                                <td>Rp. {{ number_format($item->total_gaji, '2',',','.') }}</td>

                            </tr>
                        @endforeach
                        <tr align="center">
                            <td colspan="5"><strong>Total Pembayaran Gaji {{ $tanggal_mulai }} sampai {{ $tanggal_selesai }} </strong></td>
                            <td><strong>Rp. {{ number_format($totalGajiKeseluruhan, 2, ',', '.') }}</strong></td>
                        </tr>

                        </tbody>
                    </table>
                    <form action="{{ route('laporan.gaji.pdf') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tanggal_mulai" value="{{ $tanggal_mulai }}">
                        <input type="hidden" name="tanggal_selesai" value="{{ $tanggal_selesai }}">
                        <button type="submit" class="btn btn-warning btn-sm">Cetak PDF</button>
                    </form>
                </div>
            @endisset
        </div>
    </div>
</div>

@endsection
