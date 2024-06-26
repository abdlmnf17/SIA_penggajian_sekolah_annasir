<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        return view('karyawan.index', compact('karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah terdaftar. Silakan gunakan NIK yang berbeda.',
            'max' => 'Maksimal :max karakter.',
            'min' => 'Minimal :min karakter',
        ];

        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:karyawans,nik|max:255|min:7',
            'jabatan' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:225',
            'studi' => 'required|string|max:225',
            'tgs' => 'required|string|max:225',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        $profilePhotoPath = '/img/undraw_profile.svg'; // default path

        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $request->file('profile_photo');
            $namaFile = Str::slug($request->nama).'_'.uniqid().'.'.$profilePhoto->getClientOriginalExtension();
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
        $karyawan = Karyawan::findOrFail($id);

        return view('karyawan.show', compact('karyawan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);

        return view('karyawan.edit', compact('karyawan'));
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
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string|max:255|min:7',
            'jabatan' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:225',
            'studi' => 'required|string|max:225',
            'tgs' => 'required|string|max:225',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ttl' => 'required|date',
        ]);

        $karyawan = Karyawan::findOrFail($id);

        if ($request->hasFile('profile_photo')) {

            if ($karyawan->photo) {
                Storage::disk('public')->delete($karyawan->photo);
            }
            $profilePhoto = $request->file('profile_photo');
            $namaFile = Str::slug($request->nama).'_'.uniqid().'.'.$profilePhoto->getClientOriginalExtension();
            $profilePhotoPath = $profilePhoto->storeAs('profile-photos', $namaFile, 'public'); // Menyimpan foto ke
            $karyawan->photo = $profilePhotoPath;
        }

        $updateData = [
            'nama_karyawan' => $request->nama,
            'jabatan' => $request->jabatan,
            'tugas_tambahan' => $request->tgs,
            'bidang_studi' => $request->studi,
            'no_telepon' => $request->no_telepon,
            'tanggal_lahir' => $request->ttl,

        ];

        if (! empty($request['nik'])) {
            // Jika pengguna ingin mengubah nik
            $updateData['nik'] = $request->nik;
        } else {
            // Jika tidak, gunakan yang sudah ada di database
            $updateData['nik'] = $karyawan->nik;
            // $nikBaru = $karyawan->nik;
        }

        // // Periksa apakah input nik kosong
        // if ($request->has('nik')) {
        //     // Jika tidak kosong, gunakan nilai baru
        //     $updateData['nik'] = $request->nik;
        // }

        $karyawan->update($updateData);

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui!');

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
