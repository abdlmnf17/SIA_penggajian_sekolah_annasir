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
                                        value="GAJI/01/01/....." required>
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
                                                ({{ $karyawan->jabatan }})
                                            </option>
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
                                <div class="row mb-3">
                                    <label for="tunjangan_details" class="col-md-4 col-form-label text-md-end">Detail Tunjangan</label>
                                    <div class="col-md-6">
                                        <input id="tunjangan_details" type="text" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>

                            <div id="potongan-container">
                                <div class="row mb-3">
                                    <label for="potongan_details" class="col-md-4 col-form-label text-md-end">Detail Potongan</label>
                                    <div class="col-md-6">
                                        <input id="potongan_details" type="text" class="form-control" readonly>
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
                                                {{ $honorMengajar->jam_mengajar }} | Rp.
                                                {{ number_format($honorMengajar->jumlah_mengajar, 2, ',', '.') }}</option>
                                        @endforeach
                                    </select>
                                    Honor mengajar tidak ada? silahkan isi terlebih dahulu <a href="/honormengajar"
                                        class="text-warning">di sini</a>
                                    @error('honor_mengajar_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>




                            <div class="row mb-3">
                                <label for="jumlah_absen" class="col-md-4 col-form-label text-md-end">Jumlah
                                    Absen/hari</label>
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
    var karyawanSelect = document.getElementById('karyawan_id');
    var tunjanganContainer = document.getElementById('tunjangan-container');
    var potonganContainer = document.getElementById('potongan-container');
    var totalGajiDisplay = document.getElementById('total_gaji_display');
    var totalAbsensiDisplay = document.getElementById('total_absen_display');
    var totalGajiInput = document.getElementById('total_gaji');
    var totalAbsensiInput = document.getElementById('total_absen');
    var jumlahAbsenInput = document.getElementById('jumlah_absen');
    var honorMengajarSelect = document.getElementById('honor_mengajar_id');

    // Function to update tunjangan container with individual forms
    function updateTunjanganForms(tunjangans) {
        tunjanganContainer.innerHTML = ''; // Clear previous content

        if (tunjangans.length > 0) {
            tunjanganContainer.innerHTML = tunjangans.map(function(item, index) {
                return `
                    <div class="row mb-3">
                        <label for="tunjangan_${index + 1}" class="col-md-4 col-form-label text-md-end">Tunjangan ${index + 1}</label>
                        <div class="col-md-6">
                            <input id="tunjangan_${index + 1}" type="text" class="form-control" value="${item.nama_tunjangan} | Rp. ${item.jumlah_tunjangan.toLocaleString('id-ID')}" readonly>
                        </div>
                    </div>
                `;
            }).join('');
        } else {
            tunjanganContainer.innerHTML = '<div class="row mb-3"><div class="col-md-6 offset-md-4">Tidak ada tunjangan</div></div>';
        }
        calculateTotalGaji(); // Recalculate total gaji after updating tunjangan forms
    }

    // Function to update potongan container with individual forms
    function updatePotonganForms(potongans) {
        potonganContainer.innerHTML = ''; // Clear previous content

        if (potongans.length > 0) {
            potonganContainer.innerHTML = potongans.map(function(item, index) {
                return `
                    <div class="row mb-3">
                        <label for="potongan_${index + 1}" class="col-md-4 col-form-label text-md-end">Potongan ${index + 1}</label>
                        <div class="col-md-6">
                            <input id="potongan_${index + 1}" type="text" class="form-control" value="${item.nama_potongan} | Rp. ${item.jumlah_potongan.toLocaleString('id-ID')}" readonly>
                        </div>
                    </div>
                `;
            }).join('');
        } else {
            potonganContainer.innerHTML = '<div class="row mb-3"><div class="col-md-6 offset-md-4">Tidak ada potongan</div></div>';
        }
        calculateTotalGaji(); // Recalculate total gaji after updating potongan forms
    }

    // Function to calculate total gaji
    function calculateTotalGaji() {
        var jumlahAbsen = parseInt(jumlahAbsenInput.value) || 0;
        var honorMengajar = parseInt(honorMengajarSelect.selectedOptions[0].getAttribute('data-jumlah')) || 0;

        // Calculate total tunjangan from form values
        var totalTunjangan = 0;
        tunjanganContainer.querySelectorAll('input').forEach(function(input) {
            var match = input.value.match(/Rp\. ([\d,.]+)/);
            totalTunjangan += match ? parseFloat(match[1].replace('.', '').replace(',', '.')) : 0;
        });

        // Calculate total potongan from form values
        var totalPotongan = 0;
        potonganContainer.querySelectorAll('input').forEach(function(input) {
            var match = input.value.match(/Rp\. ([\d,.]+)/);
            totalPotongan += match ? parseFloat(match[1].replace('.', '').replace(',', '.')) : 0;
        });

        var totalGaji = (jumlahAbsen * 10000) + honorMengajar + totalTunjangan - totalPotongan;
        var totalAbsensi = jumlahAbsen * 10000;

        // Formatting the numbers
        var formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });

        totalGajiDisplay.value = formatter.format(totalGaji);
        totalAbsensiDisplay.value = formatter.format(totalAbsensi);
        totalGajiInput.value = totalGaji;
        totalAbsensiInput.value = totalAbsensi;
    }

    // Event listener for karyawan selection change
    karyawanSelect.addEventListener('change', function() {
        var karyawanId = this.value;

        if (karyawanId) {
            fetch(`/api/tunjangan/${karyawanId}`)
                .then(response => response.json())
                .then(data => updateTunjanganForms(data))
                .catch(error => console.error('Error fetching tunjangan:', error));

            fetch(`/api/potongan/${karyawanId}`)
                .then(response => response.json())
                .then(data => updatePotonganForms(data))
                .catch(error => console.error('Error fetching potongan:', error));
        } else {
            updateTunjanganForms([]);
            updatePotonganForms([]);
        }
    });

    // Event listeners for input fields
    jumlahAbsenInput.addEventListener('input', calculateTotalGaji);
    honorMengajarSelect.addEventListener('change', calculateTotalGaji);
});

   </script>
@endsection
