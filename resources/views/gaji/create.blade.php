@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header bg-dark text-white">Tambah Gaji</div>

                    <div class="card-body bg-dark text-white">
                        <form method="POST" action="{{ route('gaji.store') }}">
                            @csrf


                            <div class="row mb-3">
                                <label for="kode_gaji" class="col-md-4 col-form-label text-md-end">Kode Gaji</label>
                                <div class="col-md-6">
                                    <input id="kode_gaji" type="text"
                                        class="form-control @error('kode_gaji') is-invalid @enderror" name="kode_gaji"
                                        value="GAJI/01/01/....."  required>
                                    @error('kode_gaji')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tanggal_gaji" class="col-md-4 col-form-label text-md-end">Tanggal Gaji</label>
                                <div class="col-md-6">
                                    <input id="tanggal_gaji" type="date"
                                        class="form-control @error('tanggal_gaji') is-invalid @enderror" name="tanggal_gaji"
                                        value="{{ old('tanggal_gaji') }}" required>
                                    @error('tanggal_gaji')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="karyawan_id" class="col-md-4 col-form-label text-md-end">Karyawan</label>
                                <div class="col-md-6">
                                    <select id="karyawan_id" class="form-control @error('karyawan_id') is-invalid @enderror"
                                        name="karyawan_id" required>
                                        <option value="">Pilih Karyawan</option>
                                        @foreach ($karyawans as $karyawan)
                                            <option value="{{ $karyawan->id }}">{{ $karyawan->nama_karyawan }}
                                                ({{ $karyawan->jabatan }}) </option>
                                        @endforeach
                                    </select>
                                    @error('karyawan_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="tunjangan-container">
                                <div class="row mb-3 tunjangan-row">
                                    <label for="tunjangan_1" class="col-md-4 col-form-label text-md-end">Tunjangan 1</label>
                                    <div class="col-md-6">
                                        <select id="tunjangan_1" class="form-control tunjangan-select"
                                            name="tunjangan_ids[]" required>
                                            <option value="" data-jumlah="0">Pilih Tunjangan</option>
                                            @foreach ($tunjangans as $tunjangan)
                                                <option value="{{ $tunjangan->id }}"
                                                    data-jumlah="{{ $tunjangan->jumlah_tunjangan }}">
                                                    {{ $tunjangan->nama_tunjangan }} | Rp. {{ number_format($tunjangan->jumlah_tunjangan, 2, ',', '.') }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success" id="addTunjangan">Tambah
                                            Tunjangan</button>
                                    </div>
                                </div>
                            </div>

                            <div id="potongan-container">
                                <div class="row mb-3 potongan-row">
                                    <label for="potongan_1" class="col-md-4 col-form-label text-md-end">Potongan 1</label>
                                    <div class="col-md-6">
                                        <select id="potongan_1" class="form-control potongan-select" name="potongan_ids[]"
                                            required>
                                            <option value="" data-jumlah="0">Pilih Potongan</option>
                                            @foreach ($potongans as $potongan)
                                                <option value="{{ $potongan->id }}"
                                                    data-jumlah="{{ $potongan->jumlah_potongan }}">
                                                    {{ $potongan->nama_potongan }} | Rp. {{ number_format($potongan->jumlah_potongan, 2, ',', '.') }}</option>
                                            @endforeach
                                        </select>
                                        Potongan tidak ada? silahkan isi terlebih dahulu <a href="/potongan" class="text-warning">di sini</a>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success" id="addPotongan">Tambah
                                            Potongan</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="honor_mengajar_id" class="col-md-4 col-form-label text-md-end">Honor
                                    Mengajar/jam</label>
                                <div class="col-md-6">
                                    <select id="honor_mengajar_id"
                                        class="form-control @error('honor_mengajar_id') is-invalid @enderror"
                                        name="honor_mengajar_id" required>
                                        <option value="" data-jumlah="0">Pilih Honor Mengajar</option>
                                        @foreach ($honorMengajars as $honorMengajar)
                                            <option value="{{ $honorMengajar->id }}"
                                                data-jumlah="{{ $honorMengajar->jumlah_mengajar }}">
                                                {{ $honorMengajar->jam_mengajar }} | Rp. {{ number_format($honorMengajar->jumlah_mengajar, 2, ',', '.') }}</option>
                                        @endforeach
                                    </select>
                                    Honor mengajar tidak ada? silahkan isi terlebih dahulu <a href="/honormengajar" class="text-warning">di sini</a>
                                    @error('honor_mengajar_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>




                            <div class="row mb-3">
                                <label for="jumlah_absen" class="col-md-4 col-form-label text-md-end">Jumlah Absen/hari</label>
                                <div class="col-md-6">
                                    <input id="jumlah_absen" type="number"
                                        class="form-control @error('jumlah_absen') is-invalid @enderror" name="jumlah_absen"
                                        value="{{ old('jumlah_absen') }}" required>
                                    @error('jumlah_absen')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="total_absen_display" class="col-md-4 col-form-label text-md-end">Total
                                    Absen</label>
                                <div class="col-md-6">
                                    <input id="total_absen_display" type="text" class="form-control"
                                        value="{{ old('total_absen_display') }}" readonly>
                                    <input id="total_absen" type="hidden" name="total_absen"
                                        value="{{ old('total_absen') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="total_gaji_display" class="col-md-4 col-form-label text-md-end">Total
                                    Gaji</label>
                                <div class="col-md-6">
                                    <input id="total_gaji_display" type="text" class="form-control"
                                        value="{{ old('total_gaji_display') }}" readonly>
                                    <input id="total_gaji" type="hidden" name="total_gaji"
                                        value="{{ old('total_gaji') }}">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-warning">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tunjanganContainer = document.getElementById('tunjangan-container');
            var addButtonTunjangan = document.getElementById('addTunjangan');
            var tunjanganCount = 1;

            addButtonTunjangan.addEventListener('click', function() {
                tunjanganCount++;
                var newDiv = document.createElement('div');
                newDiv.className = 'row mb-3 tunjangan-row';
                newDiv.innerHTML = `
            <label for="tunjangan_${tunjanganCount}" class="col-md-4 col-form-label text-md-end">Tunjangan ${tunjanganCount}</label>
            <div class="col-md-6">
                <select id="tunjangan_${tunjanganCount}" class="form-control tunjangan-select" name="tunjangan_ids[]" required>
                    <option value="" data-jumlah="0">Pilih Tunjangan</option>
                    @foreach ($tunjangans as $tunjangan)
                    <option value="{{ $tunjangan->id }}" data-jumlah="{{ $tunjangan->jumlah_tunjangan }}">{{ $tunjangan->nama_tunjangan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger" onclick="removeTunjangan(this)">Hapus</button>
            </div>
        `;
                tunjanganContainer.appendChild(newDiv);
                updateTunjanganListeners();
            });

            var potonganContainer = document.getElementById('potongan-container');
            var addButtonPotongan = document.getElementById('addPotongan');
            var potonganCount = 1;

            addButtonPotongan.addEventListener('click', function() {
                potonganCount++;
                var newDiv = document.createElement('div');
                newDiv.className = 'row mb-3 potongan-row';
                newDiv.innerHTML = `
            <label for="potongan_${potonganCount}" class="col-md-4 col-form-label text-md-end">Potongan ${potonganCount}</label>
            <div class="col-md-6">
                <select id="potongan_${potonganCount}" class="form-control potongan-select" name="potongan_ids[]" required>
                    <option value="" data-jumlah="0">Pilih Potongan</option>
                    @foreach ($potongans as $potongan)
                    <option value="{{ $potongan->id }}" data-jumlah="{{ $potongan->jumlah_potongan }}">{{ $potongan->nama_potongan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger" onclick="removePotongan(this)">Hapus</button>
            </div>
        `;
                potonganContainer.appendChild(newDiv);
                updatePotonganListeners();
            });

            window.removeTunjangan = function(btn) {
                btn.closest('.tunjangan-row').remove();
                calculateTotalGaji();
            };

            window.removePotongan = function(btn) {
                btn.closest('.potongan-row').remove();
                calculateTotalGaji();
            };

            function updateTunjanganListeners() {
                document.querySelectorAll('.tunjangan-select').forEach(function(select) {
                    select.removeEventListener('change', calculateTotalGaji);
                    select.addEventListener('change', calculateTotalGaji);
                });
            }

            function updatePotonganListeners() {
                document.querySelectorAll('.potongan-select').forEach(function(select) {
                    select.removeEventListener('change', calculateTotalGaji);
                    select.addEventListener('change', calculateTotalGaji);
                });
            }

            document.getElementById('jumlah_absen').addEventListener('input', calculateTotalGaji);
            document.getElementById('honor_mengajar_id').addEventListener('change', calculateTotalGaji);

            function calculateTotalGaji() {
                var jumlahAbsen = parseInt(document.getElementById('jumlah_absen').value) || 0;
                var totalAbsen = parseInt(document.getElementById('total_absen').value) || 0;
                var honorMengajar = parseInt(document.getElementById('honor_mengajar_id').selectedOptions[0]
                    .getAttribute('data-jumlah')) || 0;

                var totalTunjangan = 0;
                document.querySelectorAll('.tunjangan-select').forEach(function(select) {
                    totalTunjangan += parseInt(select.selectedOptions[0].getAttribute('data-jumlah')) || 0;
                });

                var totalPotongan = 0;
                document.querySelectorAll('.potongan-select').forEach(function(select) {
                    totalPotongan += parseInt(select.selectedOptions[0].getAttribute('data-jumlah')) || 0;
                });

                var totalGaji = (jumlahAbsen * 10000) + honorMengajar + totalTunjangan - totalPotongan;
                var totalAbsen = jumlahAbsen * 10000;

                // Formatting the numbers
                var formatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });

                document.getElementById('total_gaji_display').value = formatter.format(totalGaji);
                document.getElementById('total_absen_display').value = formatter.format(totalAbsen);
                document.getElementById('total_gaji').value = totalGaji;
                document.getElementById('total_absen').value = totalAbsen;
            }

            updateTunjanganListeners();
            updatePotonganListeners();
        });
    </script>
@endsection
