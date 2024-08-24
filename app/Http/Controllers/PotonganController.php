<?php

namespace App\Http\Controllers;

use App\Models\Potongan;
use Illuminate\Http\Request;
use App\Models\Karyawan;

class PotonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $potongan = Potongan::all();
        $karyawans = Karyawan::all();

        return view('potongan.index', compact('potongan','karyawans'));
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
            'jumlah_potongan' => ['required', 'integer'],
            'karyawan_id' => ['required', 'exists:karyawans,id'],
        ]);


        Potongan::create([
            'nama_potongan' => $request->name,
            'karyawan_id' => $request->karyawan_id,
            'jumlah_potongan' => $request->jumlah_potongan,
        ]);

        return redirect()->route('potongan.index')->with('success', 'Potongan berhasil ditambahkan.');
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
        $potongan = Potongan::findOrFail($id);

        return view('potongan.edit', compact('potongan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $potongan = Potongan::findOrFail($id);
        $validasiData = $request->validate([
            'name' => ['required', 'string', 'max:220'],
            'jumlah_potongan' => ['required', 'integer'],
        ]);

        $potongan->update([
            'nama_potongan' => $validasiData['name'],
            'jumlah_potongan' => $validasiData['jumlah_potongan'],
        ]);

        return redirect()->route('potongan.index')->with('success', 'Data berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $potongan = Potongan::findOrFail($id);
        $potongan->delete();

        return redirect()->route('potongan.index')->with('success', 'Data berhasil dihapus');
    }
}
