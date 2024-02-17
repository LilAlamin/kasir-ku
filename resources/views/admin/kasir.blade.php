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
            <br><div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title mb-0">Daftar Petugas Kasir</h6>
                    <a href="#" class="card-title mb-0 btn btn-success">Tambah Petugas Kasir</a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kasir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kasir as $kas)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$kas->username}}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning">Edit</a>
                                        <a href="#" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- Data penjualan disini -->
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>@endsection
