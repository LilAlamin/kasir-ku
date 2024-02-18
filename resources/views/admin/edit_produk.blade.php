@extends('layouts.kasir')

@section('layout')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title">Edit Petugas Kasir</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ Route('admin.produk_update',$produk->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @csrf
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Nama Produk:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                                        placeholder="Masukkan Nama Produk" value="{{ $produk->nama_produk }}">
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="password" class="col-sm-2 col-form-label">Harga Produk:</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="number" class="form-control"  name="harga"
                                            placeholder="Masukkan Harga" value="{{ $produk->harga }}">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row mt-2">
                                <label for="role" class="col-sm-2 col-form-label">Stok:</label>
                                <div class="col-sm-10">
                                    <input type="number" name="stok" placeholder="Masukkan Stok" class="form-control" value="{{ $produk->stok }}">
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                                </div>
                            </div>
                        </form></form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
