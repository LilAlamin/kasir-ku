<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;

class PenjualanController extends Controller
{
    public function index(Request $req)
    {
        if (!$req->session()->has('user_id') || $req->session()->get('user_type') !== 'kasir') {
            // Redirect jika tidak ada sesi user_id atau user_type bukan kasir
            return redirect('404')->with('error', 'Anda tidak diizinkan untuk mengakses halaman ini.');
        }
        $user_id = $req->session()->get('user_id');

        $penjualans = Penjualan::all();
        return view('kasir.index', compact('penjualans'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('kasir.tambah_penjualan', compact('produks'));
    }

    public function store(Request $request)
    {
        // Validasi request disini
    
        $totalHarga = 0;
    
        $penjualan = Penjualan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'id_user' => session('user_id'),
            // Hitung total harga berdasarkan subtotal barang yang dipilih
            'total_harga' => array_sum($request->sub_total),
        ]);
    
        foreach ($request->produk_id as $key => $value) {
            // Ambil harga awal produk
            $produk = Produk::find($value);
            $hargaAwal = $produk->harga;
    
            // Cek apakah stok mencukupi
            if ($produk->stok < $request->jumlah_produk[$key]) {
                return redirect()->back()->with('error', 'Stok produk ' . $produk->nama_produk . ' tidak mencukupi.');
            }
    
            // Hitung subtotal berdasarkan jumlah produk yang dimasukkan
            $subTotal = $hargaAwal * $request->jumlah_produk[$key];
            $totalHarga += $subTotal;
    
            // Kurangi stok produk
            $produk->stok -= $request->jumlah_produk[$key];
            $produk->save();
    
            DetailPenjualan::create([
                'penjualan_id' => $penjualan->id,
                'produk_id' => $value,
                'jumlah_produk' => $request->jumlah_produk[$key],
                'sub_total' => $subTotal,
            ]);
        }
    
        return redirect()->route('kasir.index')->with('success', 'Penjualan berhasil ditambahkan.');
    }
    


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
    return view('kasir.show', compact('penjualan'));


}



public function generatePDF($id)
{
    $penjualan = Penjualan::findOrFail($id);

    // Di sini Anda dapat menyiapkan data penjualan sesuai kebutuhan Anda
    // Contoh:
    $data = [
        'nomor_transaksi' => $penjualan->id,
        'tanggal_transaksi' => $penjualan->created_at ? $penjualan->created_at->format('d M Y H:i:s') : '-',
        'nama_pelanggan' => $penjualan->nama_pelanggan,
        'total_harga' => $penjualan->total_harga,
        'details' => $penjualan->details, // Misalkan ini adalah relasi details dari penjualan
    ];

    // Load view penjualan.pdf dengan data yang telah disiapkan
    $pdf = FacadePdf::loadView('kasir.pdf', compact('data'));

    // Download PDF
    return $pdf->stream('penjualan.pdf');
}






    // Tambahkan fungsi edit() dan update() untuk mengedit data penjualan

    // Tambahkan fungsi destroy() untuk menghapus data penjualan
}
