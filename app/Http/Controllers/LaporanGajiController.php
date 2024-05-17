<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use Illuminate\Http\Request;
use PDF;

class LaporanGajiController extends Controller
{
    public function index()
    {
        return view('laporan-gaji.index');
    }

    public function generateReport(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $tanggal_mulai = $request->input('tanggal_mulai');
        $tanggal_selesai = $request->input('tanggal_selesai');

        $gaji = Gaji::whereBetween('tanggal_gaji', [$tanggal_mulai, $tanggal_selesai])->get();

        $totalGajiKeseluruhan = $gaji->sum('total_gaji');

        return view('laporan-gaji.index', compact('gaji', 'tanggal_mulai', 'tanggal_selesai', 'totalGajiKeseluruhan'));
    }

    public function generatePdf(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $tanggal_mulai = $request->input('tanggal_mulai');
        $tanggal_selesai = $request->input('tanggal_selesai');

        $gaji = Gaji::whereBetween('tanggal_gaji', [$tanggal_mulai, $tanggal_selesai])->get();
        $totalGajiKeseluruhan = $gaji->sum('total_gaji');

        // Buat objek DomPDF
        $pdf = PDF::loadView('laporan-gaji.pdf', compact('gaji', 'tanggal_mulai', 'tanggal_selesai', 'totalGajiKeseluruhan'));

        // Atur ukuran kertas dan orientasi
        $pdf->setPaper('A4', 'landscape'); // Ubah 'A4' sesuai dengan ukuran kertas yang diinginkan, dan 'landscape' untuk orientasi landscape

        // Unduh PDF
        return $pdf->download('laporan_gaji_'.$tanggal_mulai.'_to_'.$tanggal_selesai.'.pdf');
    }
}
