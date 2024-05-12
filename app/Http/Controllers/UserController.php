<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
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
        $user = User::all();
        return view ('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'role' => ['required', 'string', Rule::in(['admin', 'user'])], // Validasi untuk field 'role'
    ]);

    // If the validation fails, the code below will not be executed.

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role, // Save the 'role' from the submitted data
    ]);

    if($user) {
        return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan.');
    } else {
        return redirect()->route('user.index')->with('error', 'Data user gagal ditambahkan.');
    }
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
        $user = User::findOrFail($id);
        return view ('user.edit', compact('user'));
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
    $user = User::findOrFail($id);
    $validatedData = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['nullable', 'string', 'min:8', 'confirmed'], // Hapus validasi 'unique:users'
        'role' => ['nullable', 'string', Rule::in(['admin', 'user'])],
    ]);

    // Periksa apakah pengguna ingin mengubah kata sandi
    if (!empty($validatedData['password'])) {
        // Jika pengguna ingin mengubah kata sandi, hash kata sandi baru
        $hashedPassword = Hash::make($validatedData['password']);
    } else {
        // Jika tidak, gunakan kata sandi yang sudah ada di database
        $hashedPassword = $user->password;
    }

    // Update data pengguna
    $user->update([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => $hashedPassword,
        'role' => $request->role,
    ]);

    // Periksa role pengguna yang sedang login
    $userRole = Auth::user()->role;

    // Redirect sesuai role pengguna yang sedang login
    if ($userRole === 'admin') {
        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui.');
    } else {
        return redirect()->route('dashboard')->with('success', 'Data user berhasil diperbarui.');
    }
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus.');



    }
}
