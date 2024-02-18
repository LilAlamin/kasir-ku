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
                        <h6 class="card-title mb-0">Daftar Petugas Kasir</h6>
                        <a href="{{ Route('admin.create_kasir') }}" class="card-title mb-0 btn btn-success">Tambah Petugas
                            Kasir</a>
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
                                @php $counter = ($kasir->currentPage() - 1) * $kasir->perPage() + 1; @endphp
                                @foreach ($kasir as $kas)
                                    @if ($kas->IsDelete == 0)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>{{ $kas->username }}</td>
                                            <td>
                                                <a href="{{ route('admin.edit_kasir', $kas->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <a href="{{ Route('admin.destroy_kasir', $kas->id) }}"
                                                    class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                <!-- Data penjualan disini -->
                            </tbody>

                        </table>
                        {{ $kasir->links() }}

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
