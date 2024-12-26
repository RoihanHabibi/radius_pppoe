<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;  // Menggunakan model Login

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
            'password' => $validated['password'],
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


    public function editPassword($id)
    {
        $admin = Login::findOrFail($id);
        return view('radcheck.editadmin', compact('admin'));
    }

    public function changePassword(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'new_password' => 'required|min:6|confirmed',
        ]);

        $admin = Login::findOrFail($id);
        $admin->password = bcrypt($request->new_password);
        $admin->save();

        return redirect()->route('admin.edit_password', ['id' => $id])
                        ->with('success', 'Password successfully updated.');
    }




}