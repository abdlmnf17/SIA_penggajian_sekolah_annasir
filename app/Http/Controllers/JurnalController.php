<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Jurnal;
use \App\Models\Akun;
use \App\Models\Gaji;
class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $akuns = Akun::all();
        $jurnals = Jurnal::with(['akunDebit', 'akunKredit'])->get();
        $gajis = Gaji::all();
        $totalDebit = $jurnals->sum('jumlah_akun_debit');
        $totalKredit = $jurnals->sum('jumlah_akun_kredit');
        return view('jurnal.index', compact('akuns', 'jurnals', 'gajis', 'totalDebit', 'totalKredit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akuns = Akun::all();
        $jurnals = Jurnal::all();
        $gajis   = Gaji::all();

        return view('jurnal.create', compact('akuns', 'jurnals', 'gajis'));

    // Menghitung total debit dan kredit
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'gaji_id' => 'required|integer|exists:gajis,id',
            'akun_debit_id' => 'required|exists:akuns,id',

            'akun_kredit_id' => 'required|exists:akuns,id',
            'keterangan' => 'required|string|max:255',
        ]);


        // Buat jurnal debit
        $debitEntry = Jurnal::create([
            'gaji_id' => $request->gaji_id,
            'akun_debit_id' => $request->akun_debit_id,
            'akun_kredit_id' => $request->akun_kredit_id,
            'jumlah_akun_debit' => $request->jumlah,
            'jumlah_akun_kredit' =>$request->jumlah,
            'keterangan' => $request->keterangan,
        ]);

        // Buat jurnal kredit
        // $debitEntry = Jurnal::create([
        //     'gaji_id' => $request->gaji_id,
        //     'akun_debit_id' => $request->akun_debit_id,
        //     'akun_kredit_id' => $request->akun_kredit_id,
        //     'jumlah_akun_debit' => 0,
        //     'jumlah_akun_kredit' => $request->jumlah,
        //     'keterangan' => $request->keterangan,
        // ]);

        // Update saldo akun debit
        $debitAkun = Akun::find($request->akun_debit_id);
        $debitAkun->jumlah_akun += $request->jumlah;
        $debitAkun->save();


        // Update saldo akun kredit
        $creditAkun = Akun::find($request->akun_kredit_id);
        $creditAkun->jumlah_akun -= $request->jumlah;
        $creditAkun->save();

        return redirect()->route('jurnal.index')->with('success', 'Jurnal berhasil disimpan.');

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
