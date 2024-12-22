<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Radcheck;

class RadcheckController extends Controller
{
    // Menampilkan daftar pengguna dengan filter status
    public function index(Request $request)
    {
        $status = $request->query('status');
        $radcheck = match ($status) {
            'enabled' => Radcheck::where('status', 1)->get(),
            'disabled' => Radcheck::where('status', 0)->get(),
            default => Radcheck::all(),
        };

        return view('radcheck.index', compact('radcheck'));
    }

    // Menampilkan dashboard dengan total pengguna aktif dan tidak aktif
    public function dashboard()
    {
        $totalActive = Radcheck::where('status', 1)->count();
        $totalInactive = Radcheck::where('status', 0)->count();

        return view('radcheck.dashboard', compact('totalActive', 'totalInactive'));
    }

    // Halaman pengguna aktif
    public function active()
    {
        $request = Radcheck::where('status', 1)->get();
        return view('radcheck.active', compact('active'));
    }

    // Halaman pengguna non-aktif
    public function inactive()
    {
        $request = Radcheck::where('status', 0)->get();
        return view('radcheck.inactive', compact('inactive'));
    }

    // Form tambah pengguna
    public function create()
    {
        return view('radcheck.create');
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        Radcheck::create([
            'username' => $request->username,
            'attribute' => 'Cleartext-Password',
            'op' => ':=',
            'value' => $request->password,
            'status' => $request->has('enabled') ? 1 : 0,
        ]);

        return redirect()->route('radcheck.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    // Form edit pengguna
    public function edit($id)
    {
        $radcheck = Radcheck::findOrFail($id);
        return view('radcheck.edit', compact('radcheck'));
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255',
        ]);

        $radcheck = Radcheck::findOrFail($id);
        $radcheck->update([
            'username' => $request->username,
        ]);

        return redirect()->route('radcheck.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    // Memperbarui status pengguna
    public function update_status(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $radcheck = Radcheck::findOrFail($id);
        $radcheck->update(['status' => $request->status]);

        return response()->json(['message' => 'Status berhasil diperbarui.']);
    }

    // Menonaktifkan pengguna
    public function destroy($id)
    {
        $radcheck = Radcheck::findOrFail($id);
        $radcheck->update(['status' => 0]);

        return response()->json(['message' => 'Pengguna berhasil dinonaktifkan.']);
    }

    // Mengubah password pengguna
    public function change_password(Request $request, $id)
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

    // Menandai pengguna sebagai enabled
    public function markAsUsed($id)
    {
        $radcheck = Radcheck::findOrFail($id);
        $radcheck->update(['status' => 1]);

        return response()->json(['message' => 'Status pengguna diubah menjadi enabled.']);
    }

    // Pencarian pengguna
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $query = $request->input('query');
        $radcheck = Radcheck::where('username', 'LIKE', "%{$query}%")
            ->orWhere('value', 'LIKE', "%{$query}%")
            ->get();

        return view('radcheck.index', compact('radcheck', 'query'));
    }
}
