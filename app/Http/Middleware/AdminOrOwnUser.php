<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminOrOwnUser
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Jika pengguna adalah admin, izinkan akses ke semua rute
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Jika pengguna bukan admin, tetapi ingin mengakses halaman edit sesuai ID mereka
        if ($request->is('user/*/edit')) {
            $requestedUserId = $request->segment(2); // Mendapatkan ID pengguna dari URL
            if ($user->id == $requestedUserId) {
                return $next($request);
            } else {
                return redirect()->route('dashboard')->with('error', 'Anda tidak diizinkan mengakses halaman ini.');
            }
        }

        // Jika pengguna bukan admin dan bukan mencoba mengakses halaman edit
        if ($request->isMethod('PUT') && $request->is('user/*')) {
            $requestedUserId = $request->segment(2); // Mendapatkan ID pengguna dari URL
            if ($user->id == $requestedUserId) {
                return $next($request);
            } else {
                return redirect()->route('dashboard')->with('error', 'Anda tidak diizinkan mengakses halaman ini.');
            }
        }

        return redirect()->route('dashboard')->with('error', 'Anda tidak diizinkan mengakses halaman tersebut.');
    }
}
