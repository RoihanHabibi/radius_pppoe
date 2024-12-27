<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;  // Menggunakan model Login
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Menampilkan form untuk membuat admin baru
    public function create()
    {
        return view('radcheck.admin');
    }

    // Menyimpan administrator baru
    public function store(Request $request)
    {
        // Validasi form
        $validated = $request->validate([
            'username' => 'required|unique:login',  // Menggunakan tabel login
            'password' => 'required|confirmed|min:5',
        ]);

        // Menyimpan data administrator dengan status 0 (inactive) saat pembuatan akun
        Login::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']), // Make sure password is hashed
            'status' => 0,  // Status 0 berarti tidak aktif
        ]);

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('radcheck.active')->with('success', 'Administrator created successfully!');
    }

    // Menampilkan administrator (baik aktif maupun tidak aktif)
    public function active(Request $request)
    {
        // Mengambil semua admin baik dengan status 1 (aktif) maupun status 0 (tidak aktif)
        $active = Login::all();

        // Menampilkan view dengan data admin
        return view('radcheck.active', compact('active'));
    }

    // Menampilkan form untuk mengedit admin
    public function editAdmin($id)
    {
        $admin = Login::findOrFail($id); // Mengambil data admin berdasarkan ID
        return view('radcheck.editadmin', compact('admin'));
    }

    // Proses update data admin
    public function updateAdmin(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'username' => 'required|unique:login,username,' . $id,  // Pastikan username unik kecuali admin yang sama
            'password' => 'nullable|min:6|confirmed',  // Validasi password jika ada perubahan
        ]);

        // Ambil admin berdasarkan ID
        $admin = Login::findOrFail($id);

        // Update username
        $admin->username = $validated['username'];

        // Jika password diubah
        if ($request->has('password') && !empty($request->password)) {
            $admin->password = ($validated['password']);  // Hash password baru
        }

        
        
        // Simpan perubahan
        $admin->save();

        // Redirect kembali ke halaman edit dengan pesan sukses
        return redirect()->route('radcheck.active', ['id' => $id])->with('success', 'Admin updated successfully');
    }
}
