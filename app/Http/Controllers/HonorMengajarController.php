<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HonorMengajar;
class HonorMengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $honormengajar = HonorMengajar::all();
        return view('honormengajar.index', compact('honormengajar'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'jam_mengajar' => ['required', 'string', 'max:200'],
            'jumlah_mengajar' => ['required', 'integer'],
        ]);

        HonorMengajar::create([
            'jam_mengajar' => $request->jam_mengajar,
            'jumlah_mengajar' => $request->jumlah_mengajar,
        ]);

        return redirect()->route('honormengajar.index')->with('success', 'Honor Mengajar berhasil ditambahkan.');

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
        $honormengajar = HonorMengajar::findOrFail($id);
        return view('honormengajar.edit', compact('honormengajar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $honormengajar = Honormengajar::findOrFail($id);
        $validasiData = $request->validate([
            'jam_mengajar' => ['required', 'string', 'max:220'],
            'jumlah_mengajar' => ['required', 'integer'],
        ]);

        $honormengajar->update([
            'jam_mengajar' => $validasiData['jam_mengajar'],
            'jumlah_mengajar' => $validasiData['jumlah_mengajar'],
        ]);

        return redirect()->route('honormengajar.index')->with('success', 'Data berhasil diperbarui');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $honormengajar = HonorMengajar::findOrFail($id);
        $honormengajar->delete();
        return redirect()->route('honormengajar.index')->with('success', 'Data berhasil dihapus');
    }
}
