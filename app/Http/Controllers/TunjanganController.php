<?php

namespace App\Http\Controllers;

use App\Models\Tunjangan;
use Illuminate\Http\Request;
use App\Models\Karyawan;

class TunjanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tunjangan = Tunjangan::all();
        $karyawans = Karyawan::all();

        return view('tunjangan.index', compact('tunjangan', 'karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            'name' => ['required', 'string', 'max:200'],
            'jumlah_tunjangan' => ['required', 'integer'],
            'karyawan_id' => ['required', 'exists:karyawans,id'],

        ]);

        Tunjangan::create([
            'nama_tunjangan' => $request->name,
            'jumlah_tunjangan' => $request->jumlah_tunjangan,
            'karyawan_id' => $request->karyawan_id,
        ]);

        return redirect()->route('tunjangan.index')->with('success', 'Tunjangan berhasil ditambahkan.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tunjangan = Tunjangan::findOrFail($id);

        return view('tunjangan.edit', compact('tunjangan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tunjangan = Tunjangan::findOrFail($id);
        $validasiData = $request->validate([
            'name' => ['required', 'string', 'max:220'],
            'jumlah_tunjangan' => ['required', 'integer'],
        ]);

        $tunjangan->update([
            'nama_tunjangan' => $validasiData['name'],
            'jumlah_tunjangan' => $validasiData['jumlah_tunjangan'],
        ]);

        return redirect()->route('tunjangan.index')->with('success', 'Data berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $tunjangan = Tunjangan::findOrFail($id);
        $tunjangan->delete();

        return redirect()->route('tunjangan.index')->with('success', 'Data berhasil dihapus');
    }
}
