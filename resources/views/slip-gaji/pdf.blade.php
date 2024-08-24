<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .header h2 {
            margin: 0;
            font-size: 20px;
            color: #555;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table th, .info-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .info-table th {
            background-color: #ff3d3d;
            color: white;
            text-align: left;
        }
        .info-table td {
            background-color: #f9f9f9;
        }
        .info-table tr:nth-child(even) td {
            background-color: #f2f2f2;
        }
        .list-group {
            margin: 10px 0;
            padding: 0;
            list-style: none;
        }
        .list-group-item {
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }
        .list-group-item:last-child {
            border-bottom: none;
        }
        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }
        .signature {
            text-align: center;
            width: 45%;
        }
        .signature p {
            margin: 0;
        }
        .signature .line {
            margin-top: 60px;
            border-top: 1px solid #000;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Slip Gaji</h1>
            <h2>{{ config('app.nama_sekolah', 'Sekolah') }}</h2>
        </div>
        <table class="info-table">
            <tbody>
                <tr>
                    <th>Kode Gaji</th>
                    <td>{{ $gaji->kode_gaji }}</td>
                </tr>
                <tr>
                    <th>Tanggal Gaji</th>
                    <td>{{ $gaji->tanggal_gaji }}</td>
                </tr>
                <tr>
                    <th>Karyawan</th>
                    <td>{{ $gaji->karyawan->nama_karyawan }}</td>
                </tr>
                <tr>
                    <th>Bidang Studi</th>
                    <td>{{ $gaji->karyawan->bidang_studi }}</td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td>{{ $gaji->karyawan->jabatan }}</td>
                </tr>
                <tr>
                    <th>Jumlah Absen/hari</th>
                    <td>{{ $gaji->jumlah_absen }} hari</td>
                </tr>
                <tr>
                    <th>Total Absen</th>
                    <td>Rp. {{ number_format($gaji->total_absen, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Honor Mengajar/jam</th>
                    <td>{{ $gaji->honorMengajar->jam_mengajar }} Jam | Rp. {{ number_format($gaji->honorMengajar->jumlah_mengajar, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Tunjangan</th>
                    <td>
                        <ul class="list-group">
                            @forelse($tunjangan as $t)
                                <li class="list-group-item">{{ $t->nama_tunjangan }}: Rp. {{ number_format($t->jumlah_tunjangan, 2, ',', '.') }}</li>
                            @empty
                                <li class="list-group-item">Tidak ada tunjangan</li>
                            @endforelse
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>Potongan</th>
                    <td>
                        <ul class="list-group">
                            @forelse($potongan as $p)
                                <li class="list-group-item">{{ $p->nama_potongan }}: - Rp. {{ number_format($p->jumlah_potongan, 2, ',', '.') }}</li>
                            @empty
                                <li class="list-group-item">Tidak ada potongan</li>
                            @endforelse
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>Total Gaji</th>
                    <td>Rp. <u><b>{{ number_format($gaji->total_gaji, 2, ',', '.') }}</b></u></td>
                </tr>
            </tbody>
        </table>

        <div class="signature-section">
            <div class="signature">
                <p class="line"></p>
                <p>Penerima: {{ $gaji->karyawan->nama_karyawan }}</p>
            </div>
            <div class="signature">
                <p class="line"></p>
                <p>Penanggung Jawab</p>
            </div>
        </div>
    </div>
</body>
</html>
