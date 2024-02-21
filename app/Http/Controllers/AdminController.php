<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\users;
use App\Models\produk;
use Barryvdh\DomPDF\PDF;

use App\Models\penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class AdminController extends Controller
{
    //
    public function index(Request $req){
        if (!$req->session()->has('user_id') || $req->session()->get('user_type') !== 'admin') {
            // Redirect jika tidak ada sesi user_id atau user_type bukan admin
            return redirect('404')->with('error', 'Anda tidak diizinkan untuk mengakses halaman ini.');
        }
        $user_id = $req->session()->get('user_id');

        $penjualans = penjualan::all();

        return view('admin.index',compact('penjualans'));
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
    public function product(Request $req){
        if (!$req->session()->has('user_id') || $req->session()->get('user_type') !== 'admin') {
            // Redirect jika tidak ada sesi user_id atau user_type bukan admin
            return redirect('404')->with('error', 'Anda tidak diizinkan untuk mengakses halaman ini.');
        }
    
        // Ambil semua pengguna yang bertipe "kasir"
        $produk = produk::where('IsDelete', 0)->paginate(5);


    
        return view('admin.produk',compact('produk'));
    }

    public function create_kasir(Request $req){
        if (!$req->session()->has('user_id') || $req->session()->get('user_type') !== 'admin') {
            // Redirect jika tidak ada sesi user_id atau user_type bukan admin
            return redirect('404')->with('error', 'Anda tidak diizinkan untuk mengakses halaman ini.');
        }
        $user_id = $req->session()->get('user_id');
        return view('admin.tambah_kasir');
    }
    public function create_product(Request $req){
        if (!$req->session()->has('user_id') || $req->session()->get('user_type') !== 'admin') {
            // Redirect jika tidak ada sesi user_id atau user_type bukan admin
            return redirect('404')->with('error', 'Anda tidak diizinkan untuk mengakses halaman ini.');
        }
        $user_id = $req->session()->get('user_id');
        return view('admin.tambah_produk');
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
    public function store_product(Request $req){
    
        produk::create([
            'nama_produk' => $req->nama_produk,
            'harga' => $req->harga,
            'stok' => $req->stok
        ]);
    
        return redirect()->route('admin.produk')->with('success', "Data Produk Berhasil Ditambahkan");
    }
    

    public function edit_kasir($id){
        // Temukan pengguna (kasir) berdasarkan ID
        $kasir = users::findOrFail($id);
        
        // Tampilkan halaman edit dengan data pengguna yang ditemukan
        return view('admin.edit_kasir', compact('kasir'));
    }

    public function edit_product($id){
        // Temukan pengguna (kasir) berdasarkan ID
        $produk = produk::findOrFail($id);
        
        // Tampilkan halaman edit dengan data pengguna yang ditemukan
        return view('admin.edit_produk', compact('produk'));
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

    public function update_product(Request $req, $id){
        // Ambil produk berdasarkan ID
        $produk = produk::findOrFail($id);
    
        // Update atribut produk
        $produk->nama_produk = $req->nama_produk;
        $produk->harga = $req->harga;
        $produk->stok = $req->stok;
    
        // Simpan perubahan
        $produk->save();
    
        return redirect()->route('admin.produk')->with('success', "Data Produk Berhasil Diperbarui");
    }
    

    public function destroy_kasir($id){
        $kasir = users::find($id);

        $kasir->IsDelete = 1;
        $kasir->save();

        return redirect()->route('admin.kasir')->with('success', 'Data Kasir berhasil dihapus.');


    }
    public function destroy_product($id){
        $produk = produk::find($id);

        $produk->IsDelete = 1;
        $produk->save();

        return redirect()->route('admin.produk')->with('success', 'Data Produk berhasil dihapus.');


    }

    // Detail Penjualan iki
    public function show($id)
    {
        // Menggunakan query builder untuk melakukan join antara tabel Penjualan dan DetailPenjualan dengan tabel Produk
        // $penjualan = Penjualan::select('penjualan.*', 'produk.nama_produk', 'produk.harga')
        //     ->join('detail_penjualan', 'penjualan.id', '=', 'detail_penjualan.penjualan_id')
        //     ->join('produk', 'detail_penjualan.produk_id', '=', 'produk.id')
        //     ->where('penjualan.id', $id)
        //     ->firstOrFail();
    
        // return view('kasir.show', compact('penjualan'));
    
        $penjualan = Penjualan::with('details.produk')->findOrFail($id);
        return view('admin.show', compact('penjualan'));
    
    
    }

    public function generatePDF()
    {
        $penjualan = Penjualan::all();
    
        // Prepare the data for the PDF view
        // $data = [
        //     'nomor_transaksi' => $penjualan->id,
        //     'tanggal_transaksi' => $penjualan->created_at ? $penjualan->created_at->format('d M Y H:i:s') : '-',
        //     'nama_pelanggan' => $penjualan->nama_pelanggan,
        //     'total_harga' => $penjualan->total_harga,
        //     'details' => $penjualan->details, // Assuming this is the relationship with sale details
        // ];
    
        // Load the PDF view with the prepared data
        $pdf = FacadePdf::loadView('admin.pdf', compact('penjualan'));
    
        // Download the PDF
        return $pdf->stream('Laporan-Penjualan.pdf');
    }
    
    
    
}
