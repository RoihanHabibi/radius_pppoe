<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Login;

class LoginController extends Controller
{
    // Menampilkan form login
    public function formLogin()
    {
        return view('radcheck.login');  // Halaman login Anda
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input login
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Ambil data dari form
        $credentials = $request->only('username', 'password');
        $username = $request->username;
        $password = $request->password;

        // Ambil row username dari database
        $query = Login::where('username', $username)->first();

        if ($query) {
            $hashedPassword = $query->password;
    
            // Cek apakah password yang dimasukkan sama dengan password di database
            if (Hash::check($password, $hashedPassword)) {
                // Jika login berhasil, redirect ke halaman PPPoE aktif
                return redirect('radcheck/dashboard');
            } else {
                // Jika login gagal
                return back()->with('error', 'Login gagal, periksa password Anda.');
            }
        } else {
            return back()->with('error', 'Login gagal, username tidak ditemukan.');
        }
    }

    //log out
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('radcheck/login')->with('status', 'Anda telah logout.');
    }

}
