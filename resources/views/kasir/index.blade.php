@extends('layouts.kasir')

@section('layout')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @php
                    // Menggunakan helper session() untuk mengambil data dari sesi
                    $userId = session('user_id');

                    // Mendapatkan username berdasarkan user_id
                    $user = \App\Models\Users::find($userId);
                    $userName = $user ? $user->username : null;
                @endphp
                <h3 style="font-family: 'Poppins',sans-serif;">Selamat Datang {{ $userName }}</h3>
                <br>
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Daftar Transaksi</h6>
                        <a href="{{ route('kasir.create') }}" class="btn btn-success">Tambah Transaksi</a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pembeli</th>
                                    <th>Total Transaksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penjualans as $key => $penjualan)
                                    @if ($penjualan->IsDelete == 0)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $penjualan->nama_pelanggan }}</td>
                                            <td>{{ $penjualan->total_harga }}</td>
                                            <td>
                                                <a href="{{ route('kasir.show', $penjualan->id) }}"
                                                    class="btn btn-primary">Detail</a>
                                                <!-- Anda dapat menambahkan tombol untuk mengedit atau menghapus penjualan di sini -->
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
