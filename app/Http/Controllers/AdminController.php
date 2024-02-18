<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function index(Request $req){
        if (!$req->session()->has('user_id') || $req->session()->get('user_type') !== 'admin') {
            // Redirect jika tidak ada sesi user_id atau user_type bukan admin
            return redirect('404')->with('error', 'Anda tidak diizinkan untuk mengakses halaman ini.');
        }
        $user_id = $req->session()->get('user_id');


        return view('admin.index');
    }
    public function kasir(Request $req){
        if (!$req->session()->has('user_id') || $req->session()->get('user_type') !== 'admin') {
            // Redirect jika tidak ada sesi user_id atau user_type bukan admin
            return redirect('404')->with('error', 'Anda tidak diizinkan untuk mengakses halaman ini.');
        }
    
        // Ambil semua pengguna yang bertipe "kasir"
        $kasir = users::where('user_type', 'kasir')
        ->where('IsDelete', 0)
        ->paginate(5);

    
        return view('admin.kasir', ['kasir' => $kasir]);
    }

    public function create_kasir(){
        return view('admin.tambah_kasir');
    }

    public function store_kasir(Request $req){

        // Hash Password Yang Di inputkan
        $passwordHash = Hash::make($req->password);
    
        // Membuat user baru dan menyimpan password yang telah di-hash
        users::create([
            'username' => $req->username,
            'password' => $passwordHash,
            'user_type' => $req->user_type,
            'IsDelete' => 0 // Mengatur IsDelete secara otomatis menjadi 0
        ]);
    
        return redirect()->route('admin.kasir')->with('success', "Data Kasir Berhasil Ditambahkan");
    }
    

    public function edit_kasir($id){
        // Temukan pengguna (kasir) berdasarkan ID
        $kasir = users::findOrFail($id);
        
        // Tampilkan halaman edit dengan data pengguna yang ditemukan
        return view('admin.edit', compact('kasir'));
    }

    public function update_kasir(Request $req, $id){
        // Validasi input
        $req->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);
    
        // Temukan pengguna (kasir) berdasarkan ID
        $kasir = users::findOrFail($id);
    
        // Perbarui username jika ada
        $kasir->username = $req->username;
    
        // Perbarui password jika diisi
        if ($req->password) {
            $kasir->password = Hash::make($req->password);
        }
    
        // Simpan perubahan
        $kasir->save();
    
        // Redirect kembali ke halaman kasir dengan pesan sukses
        return redirect()->route('admin.kasir')->with('success', 'Data Kasir Berhasil Diperbarui');
    }

    public function destroy_kasir($id){
        $kasir = users::find($id);

        $kasir->IsDelete = 1;
        $kasir->save();

        return redirect()->route('admin.kasir')->with('success', 'Data Kasir berhasil dihapus.');


    }
    
    
    
}
