@extends('layouts.app')

@section('content')

<div class="col-lg-12 mb-4 mx-auto">
    <div class="card shadow mb-4 text-white">
        <div class="card-header py-3 bg-dark">
            <h4 class="m-15 font-weight-bold">{{ __('Laporan Jurnal') }}</h4>
        </div>
        <div class="card-body bg-dark">
            <form action="{{ route('laporan.jurnal.generate') }}" method="POST">
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


            @isset($jurnals)

            <div class="container mt-10">
                <table id="jurnalTable" class="table table-bordered text-white" cellspacing="1">
                    <thead>
                        <tr align="center">
                            <th style="width: 15%">Tanggal</th>
                            <th style="width: 30%">Keterangan</th>
                            <th style="width: 15%">Akun</th>
                            <th style="width: 20%">Debit</th>
                            <th style="width: 25%">Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jurnals as $jurnal)
                        <tr align="center">
                            <td>{{ $jurnal->gaji->tanggal_gaji }}</td>
                            <td>{{ $jurnal->keterangan }}</td>
                            <td>{{ $jurnal->akunDebit->nama_akun }} <br/><hr/>{{ $jurnal->akunKredit->nama_akun }}</td>
                            <td>Rp. {{ number_format($jurnal->jumlah_akun_debit, 2, ',', '.') }}</td>
                            <td><br/>Rp. {{ number_format($jurnal->jumlah_akun_kredit, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                        <tr align="center">
                            <td colspan="3"><strong>Total</strong></td>
                            <td><strong>Rp. {{ number_format($totalDebit, 2, ',', '.') }}</strong></td>
                            <td><strong>Rp. {{ number_format($totalKredit, 2, ',', '.') }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <form action="{{ route('laporan.jurnal.pdf') }}" method="POST">
                @csrf
                <input type="hidden" name="tanggal_mulai" value="{{ $tanggal_mulai }}">
                <input type="hidden" name="tanggal_selesai" value="{{ $tanggal_selesai }}">
                <button type="submit" class="btn btn-warning btn-sm">Cetak PDF</button>
            </form>

            @endisset
        </div>
    </div>
</div>

@endsection

