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
        $gaji = Gaji::findOrFail($id);

        $pdf = PDF::loadView('slip-gaji.pdf', compact('gaji'));

        return $pdf->download('slip_gaji_'.$gaji->kode_gaji.'.pdf');
    }
}
