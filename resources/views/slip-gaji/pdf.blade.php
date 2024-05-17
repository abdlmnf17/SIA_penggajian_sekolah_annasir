<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji </title>
    <!-- Tambahkan CSS jika diperlukan -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 100%;
            margin: 5px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
    padding: 10px;
    border: 1px solid #ffffff;

    background-color: #ff3d3d;
    color: white; /* Menjadikan teks pada elemen th warna putih */
}


td {
    padding: 10px;
    border: 1px solid #eceaea;

}


        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        .signature {
            text-align: center;
        }
        .signature p {
            margin: 0;
        }
        .signature .line {
            margin-top: 60px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Slip Gaji </h1>
        <h2>{{ config('app.nama_sekolah', 'Sekolah') }}</h2>
        <table>
            <tbody>
                <tr>
                    <th scope="row">Kode Gaji</th>
                    <td>{{ $gaji->kode_gaji }}</td>
                </tr>
                <tr>
                    <th scope="row">Tanggal Gaji</th>
                    <td>{{ $gaji->tanggal_gaji }}</td>
                </tr>
                <tr>
                    <th scope="row">Karyawan</th>
                    <td>{{ $gaji->karyawan->nama_karyawan }}</td>
                </tr>
                <tr>
                    <th scope="row">Bidang Studi</th>
                    <td>{{ $gaji->karyawan->bidang_studi }}</td>
                </tr>
                <tr>
                    <th scope="row">Jabatan</th>
                    <td>{{ $gaji->karyawan->jabatan }}</td>
                </tr>
                <tr>
                    <th scope="row">Jumlah Absen/hari</th>
                    <td>{{ $gaji->jumlah_absen }} hari</td>
                </tr>
                <tr>
                    <th scope="row">Total Absen</th>
                    <td>Rp. {{ number_format($gaji->total_absen, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th scope="row">Honor Mengajar/jam</th>
                    <td>{{ $gaji->honorMengajar->jam_mengajar }} Jam | Rp. {{ number_format($gaji->honorMengajar->jumlah_mengajar, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th scope="row">Tunjangan</th>
                    <td>
                        <ul class="list-group mb-3">
                            @foreach($gaji->tunjangan as $tunjangans)
                                <li class="list-group-item">{{ $tunjangans->nama_tunjangan }}: Rp. {{ number_format($tunjangans->jumlah_tunjangan, 2, ',', '.') }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Potongan</th>
                    <td>
                        <ul class="list-group mb-3">
                            @foreach($gaji->potongan as $potongans)
                                <li class="list-group-item">{{ $potongans->nama_potongan }}: - Rp. {{ number_format($potongans->jumlah_potongan, 2, ',', '.') }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Total Gaji</th>
                    <td>Rp. <u><b>{{ number_format($gaji->total_gaji, 2, ',', '.') }}</b></u></td>
                </tr>
            </tbody>
        </table>

        <div class="signature-section">

            <div class="signature-section">
                <p class="line">______________________________</p>
                <p>Penerima {{ $gaji->karyawan->nama_karyawan }}</p>
            </div>
    </div><br/>
</body>
</html>
