<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\HonorMengajar;
use App\Models\Karyawan;
use App\Models\Potongan;
use App\Models\Tunjangan;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gajis = Gaji::with(['karyawan', 'tunjangan', 'potongan', 'honorMengajar'])->get();

        return view('gaji.index', compact('gajis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $karyawans = Karyawan::all();
        $tunjangans = Tunjangan::all();
        $potongans = Potongan::all();
        $honorMengajars = HonorMengajar::all();

        return view('gaji.create', compact('karyawans', 'tunjangans', 'potongans', 'honorMengajars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'honor_mengajar_id' => 'required|exists:honormengajars,id',
            'kode_gaji' => 'required|string|unique:gajis,kode_gaji|max:255',
            'tanggal_gaji' => 'required|date',
            'jumlah_absen' => 'required|integer',
            'total_absen' => 'required|integer',
            'total_gaji' => 'required|integer',
            'tunjangan_ids.*' => 'required|exists:tunjangans,id',
            'potongan_ids.*' => 'required|exists:potongans,id',
        ]);

        // Buat entri gaji
        $gaji = Gaji::create($request->except('tunjangan_ids', 'potongan_ids'));

        // Lampirkan tunjangan yang dipilih ke entri gaji menggunakan attach
        $tunjanganIds = collect($request->tunjangan_ids)->unique(); // Hapus duplikat tunjangan jika ada
        $potonganIds = collect($request->potongan_ids)->unique(); // Hapus duplikat potongan jika ada
        $gaji->tunjangan()->attach($tunjanganIds);
        $gaji->potongan()->attach($potonganIds);

        return redirect()->route('gaji.index')->with('success', 'Gaji berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gaji = Gaji::with(['karyawan', 'tunjangan', 'potongan', 'honorMengajar'])->findOrFail($id);

        return view('gaji.detail', compact('gaji'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tunjangan_id' => 'required|exists:tunjangans,id',
            'potongan_id' => 'required|exists:potongans,id',
            'honor_mengajar_id' => 'required|exists:honor_mengajars,id',
            'kode_gaji' => 'required|string|max:255',
            'tanggal_gaji' => 'required|date',
            'jumlah_absen' => 'required|integer',
            'total_absen' => 'required|integer',
            'total_gaji' => 'required|integer',
        ]);

        $gaji->update($request->all());

        return redirect()->route('gaji.index')->with('success', 'Gaji berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gaji = Gaji::findOrFail($id);
        $gaji->delete();

        return redirect()->route('gaji.index')->with('success', 'Gaji berhasil dihapus');
    }
}
