<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use PDF;

class SlipGajiController extends Controller
{
    public function index()
    {

        return view('gaji.index');
    }

    public function generatePDF($id)
    {
        $gaji = Gaji::with(['karyawan', 'honorMengajar'])->findOrFail($id);

        // Ambil tunjangan dan potongan berdasarkan karyawan
        $tunjangan = $gaji->karyawan->tunjangan;
        $potongan = $gaji->karyawan->potongan;

        $pdf = PDF::loadView('slip-gaji.pdf', compact('gaji', 'tunjangan', 'potongan'));

        return $pdf->stream('slip_gaji_'.$gaji->kode_gaji.'.pdf');
    }

}
