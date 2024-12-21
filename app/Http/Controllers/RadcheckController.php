<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Radcheck;


class RadcheckController extends Controller
{
    // Menampilkan data pengguna aktif dan tidak aktif berdasarkan pencarian
    public function index(Request $request)
    {
        $status = $request->query('status'); // Mengambil query string 'status'

        if ($status == 'enabled') {
            $radcheck = Radcheck::where('status', 'enabled')->get();
        } else if ($status == 'disabled') {
            $radcheck = Radcheck::where('status', 'disabled')->get();
        } else {
            $radcheck = Radcheck::all(); // Mengambil semua data jika tidak ada filter
        }

        return view('radcheck.index', compact('radcheck')); // Mengirim data ke view
    }

    // Menambahkan pengguna baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255',
            
        ]);

        // Simpan data baru ke tabel radcheck
        Radcheck::create([
            'username' => $request->username,
            'attribute' => 'Cleartext-Password', // Default attribute
            'op' => ':=', // Default operator
            'value' => $request->password,
            'status' => 'enabled', // Set status default sebagai "enabled"
        ]);

        return redirect()->route('radcheck.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    // Mengedit pengguna
    public function edit($id)
    {
        $radcheck = Radcheck::findOrFail($id);
        return view('radcheck.edit', compact('radcheck'));
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
        ]);

        $radcheck = Radcheck::findOrFail($id);
        $radcheck->update([
            'username' => $validated['username'],
        ]);

        return redirect()->route('radcheck.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    // Memperbarui status pengguna
    public function update_status(Request $request, $id)
    {
        $status = $request->input('status');
        $user = Radcheck::find($id);

        if (!$user) {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
        }

        // Perbarui status hanya jika berbeda
        if ($user->status !== $status) {
            $user->status = $status;
            $user->save();
        }

        return response()->json(['message' => 'Status berhasil diperbarui']);
    }

    // Menonaktifkan pengguna (mengubah status menjadi disabled)
    public function destroy($id)
    {
        $radcheck = Radcheck::find($id);

        if (!$radcheck) {
            return response()->json(['message' => 'Data tidak ditemukan.'], 404);
        }

        // Nonaktifkan pengguna
        $radcheck->update([
            'status' => 'disabled',
        ]);

        return response()->json(['message' => 'Data berhasil dihapus.'], 200);
    }

    // Mengubah password pengguna
    public function change_password($id, Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6',
        ]);

        $radcheck = Radcheck::findOrFail($id);

        if ($radcheck->value === $request->old_password) {
            $radcheck->update(['value' => $request->new_password]);
            return redirect()->route('radcheck.index')->with('success', 'Password berhasil diperbarui.');
        }

        return redirect()->route('radcheck.index')->with('error', 'Password lama tidak valid.');
    }

    // Menandai pengguna sebagai "enabled"
    public function markAsUsed($id)
    {
        $user = Radcheck::find($id);

        if (!$user) {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
        }

        // Ubah status menjadi "enabled"
        $user->status = 'enabled';
        $user->save();

        return response()->json(['message' => 'Status pengguna diubah menjadi enabled']);
    }

    // Mencari pengguna berdasarkan query pencarian
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return redirect()->route('radcheck.index')->with('error', 'Masukkan kata kunci untuk mencari.');
        }

        // Cari berdasarkan username atau password
        $radcheck = Radcheck::where('username', 'LIKE', "%{$query}%")
            ->orWhere('value', 'LIKE', "%{$query}%")
            ->get();

        if ($radcheck->isEmpty()) {
            return redirect()->route('radcheck.index')->with('error', 'Data tidak ditemukan.');
        }

        return view('radcheck.index', compact('radcheck', 'query'));
    }
}
