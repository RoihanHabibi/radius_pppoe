<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Radcheck;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
        
        $recentUsers = Radcheck::orderBy('tanggal_penggunaan', 'desc')->limit(7)->get(); // Sesuaikan limit jika perlu
        return view('radcheck.dashboard', compact('totalActive', 'totalInactive', 'recentUsers'));
    }

    // Halaman pengguna aktif
    public function active()
    {
        $active = Radcheck::where('status', 1)->get();
        return view('radcheck.active', compact('active'));
    }

    // Halaman pengguna non-aktif
    public function inactive()
    {
        $inactive = Radcheck::where('status', 0)->get();
        return view('radcheck.inactive', compact('inactive'));
    }

    // Form tambah pengguna
    public function create()
    {
        return view('radcheck.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        // Simpan pengguna baru
        Radcheck::create([
            'username' => $request->username,
            'attribute' => 'Cleartext-Password',
            'op' => ':=',
            'value' => $request->password,
            'status' => $request->has('enabled') ? 1 : 0,
            'tanggal_penggunaan' => Carbon::now(), // Menggunakan zona waktu Jakarta
        ]);
    
        return redirect()->route('radcheck.dashboard')->with('success', 'Pengguna berhasil ditambahkan.');
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

    public function update_status(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        // Temukan pengguna berdasarkan ID
        $radcheck = Radcheck::findOrFail($id);

        // Perbarui status
        $radcheck->update(['status' => $request->status]);

        // Jika status adalah 'disabled' (0), ganti password
        if ($request->status == 0) {

            // Gunakan string random password dengan maksimal 5 huruf
            $hashedPassword = Str::random(5);

            // Update password pengguna
            $radcheck->update(['value' => $hashedPassword]);

            // (Opsional) Kirim password baru ke pengguna melalui notifikasi atau email
            // Mail::to($radcheck->email)->send(new PasswordUpdated($newPassword));
        }

        return response()->json(['message' => 'Status berhasil diperbarui dan password diperbarui jika status adalah disabled.']);
    }


    // Menonaktifkan pengguna
    public function disableUser($id)
    {
        $radcheck = Radcheck::findOrFail($id);

        // Perbarui status menjadi 0 (dinonaktifkan) dan ubah password ke string acak
        $radcheck->update([
            'status' => 0,
            'value' => bcrypt(str::random(5)) // Ganti password dengan acak
        ]);

        return response()->json(['message' => 'Pengguna berhasil dinonaktifkan.']);
    }

    // Mengubah password pengguna
    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6',
        ]);

        $radcheck = Radcheck::findOrFail($id);

        // Validasi apakah password lama sesuai
        if (password_verify($request->old_password, $radcheck->value)) {
            $radcheck->update(['value' => bcrypt($request->new_password)]); // Hash password baru
            return redirect()->route('radcheck.index')->with('success', 'Password berhasil diperbarui.');
        }

        return redirect()->route('radcheck.index')->with('error', 'Password lama tidak valid.');
    }

    // Mengaktifkan kembali pengguna (opsional jika dibutuhkan)
    public function enableUser($id)
    {
        $radcheck = Radcheck::findOrFail($id);

        // Perbarui status menjadi 1 (aktif)
        $radcheck->update(['status' => 1]);

        return response()->json(['message' => 'Pengguna berhasil diaktifkan kembali.']);
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

     // Fungsi untuk menghasilkan password acak dengan panjang 5 karakter
     public function generateRandomPassword($length = 5)
     {
         return Str::random($length); // Menghasilkan password acak dengan panjang yang ditentukan
     }
 
     // Menyimpan pengguna baru dengan password acak
     public function RandomPassword(Request $request)
     {
         // Validasi input username
         $request->validate([
             'username' => 'required|string|max:255',
         ]);
 
         // Membuat password acak dengan panjang 5 karakter
         $randomPassword = $this->generateRandomPassword(5); // Maksimal 5 karakter
 
         // Menambahkan pengguna baru ke tabel radcheck
         Radcheck::create([
             'username' => $request->username,
             'attribute' => 'Cleartext-Password',
             'op' => ':=',
             'value' => $randomPassword,
             'status' => $request->has('enabled') ? 1 : 0, // Status pengguna aktif/tidak
         ]);
 
         // Redirect kembali ke dashboard dengan pesan sukses
         return redirect()->route('radcheck.dashboard')
             ->with('success', "Pengguna berhasil ditambahkan dengan password: $randomPassword");
     }

     // Metode untuk menghapus pengguna
     public function destroy($id)
     {
         // Mencari pengguna berdasarkan ID
         $user = Radcheck::find($id);
     
         // Mengecek apakah pengguna ditemukan
         if ($user) {
             // Menonaktifkan pengguna dengan mengubah status menjadi 0
             $user->status = 0;
             $user->save(); // Simpan perubahan status
     
             // Mengirimkan respons sukses
             return response()->json(['message' => 'Pengguna berhasil dinonaktifkan'], 200);
         }
     
         // Jika pengguna tidak ditemukan, kirimkan respons error
         return response()->json(['error' => 'Pengguna tidak ditemukan'], 404);
     }

     public function getAdditionalData()
     {
         // Mengambil data dari koneksi kedua
         $additionalData = DB::connection('mysql_secondary')->table('users')
             ->select('id', 'username', 'phone', 'address')
             ->get();
 
         return view('radcheck.additional', compact('additionalData'));
     }
 
     public function combineUserData()
     {
         // Data dari database utama
         $mainData = DB::table('radcheck')->get();
 
         // Data dari database kedua
         $secondaryData = DB::connection('mysql_secondary')->table('users')->get();
 
         // Menggabungkan data
         $combinedData = $mainData->map(function ($user) use ($secondaryData) {
             $secondaryUser = $secondaryData->firstWhere('username', $user->username);
 
             return [
                 'id' => $user->id,
                 'username' => $user->username,
                 'status' => $user->status,
                 'phone' => $secondaryUser->phone ?? null,
                 'address' => $secondaryUser->address ?? null,
             ];
         });
 
         return view('radcheck.combined', compact('combinedData'));
     }
     

}
