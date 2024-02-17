<?php

namespace App\Http\Controllers;

use App\Models\users;

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
        $data = DB::table('user')
        ->where(function ($query) use ($req) {
            $query->where('username', '=', $req->username);
        })
        ->first(['id', 'user_type', 'password']);

    if ($data && Hash::check($req->password, $data->password)) {
        $req->session()->put('user_id', $data->id);
        $req->session()->put('user_type', $data->user_type);

        if ($data->user_type == 'kasir') {
            return redirect('/kasir');
        } elseif ($data->user_type == 'admin') {
            return redirect('/admin');
        } else {
            return redirect('/')->with('gagal', 'Akun Anda Tidak Terdaftar');
        }
    } else {
        return redirect('/')->with('gagal', 'Akun Anda Tidak Terdaftar');
    }
    }

    public function logout(Request $req){
        $req->session()->flush('user_id');
        return redirect('/');
    }
}
