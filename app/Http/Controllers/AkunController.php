<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index()
    {
        $akun = Akun::all();

        return view('akun.index', compact('akun'));
    }

    public function create()
    {
        return view('akun.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_akun' => ['required', 'string', 'max:200'],
            'jenis_akun' => ['required', 'string'],
            'kode_akun' => ['required', 'string'],
            'jumlah_akun' => ['required', 'integer'],
        ]);

        Akun::create([
            'nama_akun' => $request->nama_akun,
            'jenis_akun' => $request->jenis_akun,
            'kode_akun' => $request->kode_akun,
            'jumlah_akun' => $request->jumlah_akun,
        ]);

        return redirect()->route('akun.index')->with('success', 'Akun berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $akun = Akun::findOrFail($id);

        return view('akun.edit', compact('akun'));
    }

    public function update(Request $request, $id)
    {
        $akun = Akun::findOrFail($id);
        $validasiData = $request->validate([
            'nama_akun' => ['required', 'string', 'max:220'],
            'jenis_akun' => ['required', 'string'],

        ]);

        $akun->update([
            'nama_akun' => $validasiData['nama_akun'],
            'jenis_akun' => $validasiData['jenis_akun'],
            'kode_akun' => $akun->kode_akun,
            'jumlah_akun' => $akun->jumlah_akun,
        ]);

        return redirect()->route('akun.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $akun = Akun::findOrFail($id);
        $akun->delete();

        return redirect()->route('akun.index')->with('success', 'Data berhasil dihapus');
    }
}
