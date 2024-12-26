<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Login;

class LoginController extends Controller
{
    // Menampilkan form login
    public function formLogin()
    {
        return view('radcheck.login');
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
        $username = $request->username;
        $password = $request->password;

        // Ambil data pengguna berdasarkan username
        $user = Login::where('username', $username)->first();

        if ($user) {
            // Cek apakah password yang dimasukkan sesuai dengan password di database (menggunakan password biasa)
            if ($password === $user->password) {
                // Jika status pengguna adalah 0 (Inactive), ubah menjadi 1 (Active)
                if ($user->status == 0) {
                    $user->status = 1;
                    $user->save(); // Simpan perubahan status
                }

                // Menyimpan username ke dalam session jika login berhasil
                session(['username' => $user->username]);

                // Setelah login berhasil, redirect ke halaman dashboard atau halaman yang diinginkan
                return redirect('radcheck/dashboard')->with('success', 'Login successful.');
            } else {
                // Jika password salah
                return back()->with('error', 'Login gagal, periksa password Anda.');
            }
        } else {
            // Jika username tidak ditemukan
            return back()->with('error', 'Login gagal, username tidak ditemukan.');
        }
    }

    // Logout
    public function logout(Request $request)
    {
        // Ambil username dari session untuk memastikan user yang sedang login
        $username = session('username');

        // Jika username ada dalam session, lakukan update status menjadi 0
        if ($username) {
            $user = Login::where('username', $username)->first();

            if ($user) {
                // Update status menjadi 0 (inactive)
                $user->status = 0;
                $user->save(); // Pastikan data disimpan
            }

            // Logout pengguna dan hapus session
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        // Redirect ke halaman login setelah logout
        return redirect('radcheck/login')->with('status', 'Anda telah logout dan status Anda diubah menjadi Inactive.');
    }
}
