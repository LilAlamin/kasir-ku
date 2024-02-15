<?php

namespace App\Http\Controllers;

use App\Models\pelanggann;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class auth extends Controller
{
    //
    public function login(){
        return view('auth');
    }

    public function masuk(Request $req){
        $data = DB::table('pelanggan')
        ->where(function ($query) use ($req) {
            $query->where('nama_pelanggan', '=', $req->username);
        })
        ->first(['id', 'user_type', 'password']);

    if ($data && Hash::check($req->password, $data->password)) {
        $req->session()->put('pelanggan_id', $data->id);
        $req->session()->put('user_type', $data->user_type);

        if ($data->user_type == 'kasir') {
            return redirect('/wal');
        } elseif ($data->user_type == 'pelanggan') {
            return redirect('/pelanggan');
        } else {
            return redirect('/')->with('gagal', 'Akun Anda Tidak Terdaftar');
        }
    } else {
        return redirect('/')->with('gagal', 'Akun Anda Tidak Terdaftar');
    }
    }
}
