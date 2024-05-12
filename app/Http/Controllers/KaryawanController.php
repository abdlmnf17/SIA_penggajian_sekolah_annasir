<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
     }


    public function index()
    {
        $karyawan = Karyawan::all();
        return view ('karyawan.index', compact('karyawan'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah terdaftar. Silakan gunakan NIK yang berbeda.',
            'max' => 'Maksimal :max karakter.',
        ];

        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:karyawans,nik|max:255',
            'jabatan' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:225',
            'studi' => 'required|string|max:225',
            'tgs' => 'required|string|max:225',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ttl' => 'required|date',

        ], $messages, [
            'nama' => 'Nama',
            'nik' => 'NIK',
            'jabatan' => 'Jabatan',
            'tgs' => 'Tugas Tambahan',
            'no_telepon' => 'No Telepon',
            'profile_photo' => 'Foto Profil',
            'ttl' => 'Tanggal Lahir',
            'studi' => 'Bidang Studi',

        ]);

        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $request->file('profile_photo');
            $namaFile = Str::slug($request->nama) . '_' . uniqid() . '.' . $profilePhoto->getClientOriginalExtension();

            $profilePhotoPath = $profilePhoto->storeAs('profile-photos', $namaFile, 'public');
        }


        Karyawan::create([
            'nama_karyawan' => $request->nama,
            'nik' => $request->nik,
            'jabatan' => $request->jabatan,
            'tugas_tambahan' => $request->tgs,
            'bidang_studi' => $request->studi,
            'no_telepon' => $request->no_telepon,
            'photo' => $profilePhotoPath,
            'tanggal_lahir' => $request->ttl,
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan!');


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
     * @param  \Illuminate\Http\Request  $request
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
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();
        return redirect()->route('karyawan.index')->with('success', 'Data berhasil dihapus.');


    }
}
