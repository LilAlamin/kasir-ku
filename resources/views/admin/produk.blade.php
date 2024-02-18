@extends('layouts.kasir')

@section('layout')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{-- @php
                    // Menggunakan helper session() untuk mengambil data dari sesi
                    $userId = session('user_id');

                    // Mendapatkan username berdasarkan user_id
                    $user = \App\Models\users::find($userId);
                    $userName = $user ? $user->username : null;
                @endphp
                <h3 style="font-family: 'Poppins',sans-serif;">Selamat Datang, {{ $userName }}</h3> --}}
                <br>
                @if (session('success'))
                    <div id="successMessage" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    <script>
                        // Menghilangkan pesan sukses setelah 2 detik
                        setTimeout(function() {
                            document.getElementById('successMessage').style.display = 'none';
                        }, 2000);
                    </script>
                @endif


                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Daftar Produk</h6>
                        <a href="{{ Route('admin.produk_create') }}" class="card-title mb-0 btn btn-success">Tambah Produk</a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Stok Barang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = ($produk->currentPage() - 1) * $produk->perPage() + 1; @endphp
                                @foreach ($produk as $pro)
                                    @if ($pro->IsDelete == 0)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>{{ $pro->nama_produk }}</td>
                                            <td>Rp. {{ number_format($pro->harga, 0, ',', '.') }}</td>
                                            <td>{{ $pro->stok }}</td>
                                            <td>
                                                <a href=""
                                                    class="btn btn-warning">Edit</a>
                                                <a href=""
                                                    class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                <!-- Data penjualan disini -->
                            </tbody>

                        </table>
                        {{ $produk->links() }}

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
