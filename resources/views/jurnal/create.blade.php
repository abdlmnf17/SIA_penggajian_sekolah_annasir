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
                <h4 class="m-15 font-weight-bold">{{ __('Input Jurnal') }}</h4>
            </div>
            <div class="card-body bg-dark">
                <form action="{{ route('jurnal.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="akun_debit_id">Akun Debit:</label>

                        <select name="akun_debit_id" id="akun_debit_id" class="form-control">
                            <option value="" data-jumlah="0">Pilih Akun</option>
                            @foreach ($akuns as $akun)
                                <option value="{{ $akun->id }}">{{ $akun->nama_akun }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gaji_id">Kode Gaji:</label>
                        <select name="gaji_id" id="gaji_id" class="form-control" onchange="updateJumlah()">
                            @foreach ($gajis as $gaji)
                                <option value="" data-jumlah="0">Pilih Gaji</option>
                                <option value="{{ $gaji->id }}" data-jumlah="{{ $gaji->total_gaji }}">
                                    {{ $gaji->kode_gaji }} | {{ $gaji->karyawan->nama_karyawan }} | Rp.
                                    {{ number_format($gaji->total_gaji, 2, ',', '.') }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah:</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" step="0.01" required
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="akun_kredit_id">Akun Kredit:</label>
                        <select name="akun_kredit_id" id="akun_kredit_id" class="form-control">
                            <option value="" data-jumlah="0">Pilih Akun</option>
                            @foreach ($akuns as $akun)
                                <option value="{{ $akun->id }}">{{ $akun->nama_akun }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan:</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function updateJumlah() {
            const gajiSelect = document.getElementById('gaji_id');
            const selectedGaji = gajiSelect.options[gajiSelect.selectedIndex];
            const jumlah = selectedGaji.getAttribute('data-jumlah');
            document.getElementById('jumlah').value = jumlah;
        }
    </script>
@endsection
