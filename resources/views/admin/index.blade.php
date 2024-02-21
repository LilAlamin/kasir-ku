@extends('layouts.kasir')

@section('layout')
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
                <h3 style="font-family: 'Poppins',sans-serif;">Selamat Datang, {{ $userName }}</h3>
                <br>
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Daftar Transaksi</h6>
                        <a href="{{ Route('admin.pdf') }}" class="btn btn-primary">Download Laporan</a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Transaksi/Waktu</th>
                                    <th>Pelayanan Kasir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data penjualan disini -->
                                @foreach ($penjualans as $key => $penjualan)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $penjualan->created_at ? $penjualan->created_at->isoFormat('dddd, D MMMM YYYY / H:mm:ss') : '' }}</td>

                                        <td>
                                            @if ($penjualan->user)
                                                <!-- Periksa apakah relasi user tidak null -->
                                                {{ $penjualan->user->username }}
                                            @else
                                                User tidak ditemukan
                                                <!-- Atau pesan yang sesuai jika user tidak ditemukan -->
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.show', $penjualan->id) }}"
                                                class="btn btn-primary"><i class="bi bi-eye"></i> Detail</a>
                                            <!-- Anda dapat menambahkan tombol untuk mengedit atau menghapus penjualan di sini -->
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
