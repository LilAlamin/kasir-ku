<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\users;
use Illuminate\Http\Request;

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
        $kasir = users::where('user_type', 'kasir')->get();
    
        return view('admin.kasir', ['kasir' => $kasir]);
    }
    
}
