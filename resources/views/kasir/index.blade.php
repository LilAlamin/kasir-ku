@extends('layouts.kasir')

@section('kasir')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @php
                    // Menggunakan helper session() untuk mengambil data dari sesi
                    $userId = session('user_id');

                    // Mendapatkan username berdasarkan user_id
                    $user = \App\Models\users::find($userId);
                    $userName = $user ? $user->username : null;
                @endphp
                <h3 style="font-family: 'Poppins',sans-serif;">Selamat Datang {{ $userName }}</h3>
                <br><div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Daftar Transaksi</h6>
                        <button class="btn btn-success">Tambah Transaksi</button>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pembeli</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data penjualan disini -->
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
