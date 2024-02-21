@extends('layouts.kasir')

@section('layout')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div id="successMessage" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    <script>
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
                        <div class="row">
                            @foreach ($produk as $pro)
                                @if ($pro->IsDelete == 0)
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $pro->nama_produk }}</h5>
                                                <p class="card-text">Harga: Rp. {{ number_format($pro->harga, 0, ',', '.') }}</p>
                                                <p class="card-text">Stok: {{ $pro->stok }}</p>
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ Route('admin.produk_edit',$pro->id) }}" class="btn btn-warning">Edit</a>
                                                    <a href="{{ Route('admin.destroy_produk',$pro->id) }}" class="btn btn-danger">Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="card-footer">
                        {{ $produk->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
