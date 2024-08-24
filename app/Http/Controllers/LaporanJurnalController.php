<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request; // Ganti dengan model jurnal yang sesuai
use PDF;

class LaporanJurnalController extends Controller
{
    public function index()
    {

        return view('laporan-jurnal.index');
    }

    public function generateReport(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $tanggal_mulai = $request->input('tanggal_mulai');
        $tanggal_selesai = $request->input('tanggal_selesai');
        $jurnals = Jurnal::whereHas('gaji', function ($query) use ($tanggal_mulai, $tanggal_selesai) {
            $query->whereBetween('tanggal_gaji', [$tanggal_mulai, $tanggal_selesai]);
        })->get();

        $totalDebit = $jurnals->sum('jumlah_akun_debit');
        $totalKredit = $jurnals->sum('jumlah_akun_kredit');

        return view('laporan-jurnal.index', compact('jurnals', 'tanggal_mulai', 'tanggal_selesai', 'totalDebit', 'totalKredit'));
    }

    public function generatePdf(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $tanggal_mulai = $request->input('tanggal_mulai');
        $tanggal_selesai = $request->input('tanggal_selesai');
        $jurnals = Jurnal::whereHas('gaji', function ($query) use ($tanggal_mulai, $tanggal_selesai) {
            $query->whereBetween('tanggal_gaji', [$tanggal_mulai, $tanggal_selesai]);
        })->get();
        $totalDebit = $jurnals->sum('jumlah_akun_debit');
        $totalKredit = $jurnals->sum('jumlah_akun_kredit');

        // Buat objek DomPDF
        $pdf = PDF::loadView('laporan-jurnal.pdf', compact('jurnals', 'tanggal_mulai', 'tanggal_selesai', 'totalDebit', 'totalKredit'));

        // Atur ukuran kertas dan orientasi
        $pdf->setPaper('A4', 'landscape'); // Ubah 'A4' sesuai dengan ukuran kertas yang diinginkan, dan 'landscape' untuk orientasi landscape

        // Unduh PDF
        return $pdf->stream('laporan_jurnal_'.$tanggal_mulai.'_to_'.$tanggal_selesai.'.pdf');
    }
}
