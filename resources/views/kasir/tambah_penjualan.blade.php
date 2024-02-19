@extends('layouts.kasir')

@section('layout')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session('error'))
            <div id="errorAlert" class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        <script>
            // Menghilangkan alert setelah 2 detik
            setTimeout(function() {
                var errorAlert = document.getElementById('errorAlert');
                if (errorAlert) {
                    errorAlert.style.display = 'none';
                }
            }, 2000);
        </script>
        
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Form Tambah Transaksi</h5>
                </div>
                <div class="card-body">
                    <form action="{{ Route('kasir.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_pelanggan">Nama Pelanggan:</label>
                            <input type="text" name="nama_pelanggan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="produk_id">Pilih Produk: (Ctrl + Klik , Untuk Memilih Produk lebih dari 1)</label>
                            <select name="produk_id[]" id="produk_id" class="form-control" multiple required>
                                @foreach ($produks as $produk)
                                <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}">
                                    {{ $produk->nama_produk }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="produk-details">
                            <!-- Product details will be displayed here -->
                        </div>
                        <div class="form-group">
                            <label for="total_harga">Total Harga:</label>
                            <input type="text" name="total_harga" id="total_harga" class="form-control" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .input-group-append {
        position: absolute;
        right: 0;
        top: 0;
        height: 100%;
    }

    .produk-item {
        border-bottom: 1px solid #ccc;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    .produk-item label {
        font-weight: bold;
    }

    .produk-item input {
        width: 100px;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const produkSelect = document.getElementById('produk_id');
        const produkDetails = document.getElementById('produk-details');
        const totalHargaInput = document.getElementById('total_harga');

        produkSelect.addEventListener('change', function() {
            let selectedOptions = produkSelect.selectedOptions;
            produkDetails.innerHTML = ''; // Bersihkan detail produk sebelum menambahkan yang baru
            let totalHarga = 0;

            for (let option of selectedOptions) {
                let hargaAwal = parseFloat(option.getAttribute('data-harga'));

                let produkItem = document.createElement('div');
                produkItem.classList.add('produk-item');

                let label = document.createElement('label');
                label.innerHTML = option.text + ' - Harga: ' + hargaAwal.toFixed(2);

                let jumlahProdukInput = document.createElement('input');
                jumlahProdukInput.setAttribute('type', 'text');
                jumlahProdukInput.setAttribute('name', 'jumlah_produk[]');
                jumlahProdukInput.setAttribute('class', 'form-control');
                jumlahProdukInput.setAttribute('placeholder', 'Jumlah Produk');

                let subTotalInput = document.createElement('input');
                subTotalInput.setAttribute('type', 'text');
                subTotalInput.setAttribute('name', 'sub_total[]');
                subTotalInput.setAttribute('class', 'form-control');
                subTotalInput.setAttribute('readonly', 'readonly');

                jumlahProdukInput.addEventListener('input', function() {
                    let jumlahProduk = parseFloat(jumlahProdukInput.value);
                    let subTotal = hargaAwal * jumlahProduk;
                    subTotalInput.value = subTotal.toFixed(2);

                    totalHarga = 0;
                    document.querySelectorAll('[name="sub_total[]"]').forEach(input => {
                        totalHarga += parseFloat(input.value);
                    });
                    totalHargaInput.value = totalHarga.toFixed(2);
                });

                let jumlahProdukLabel = document.createElement('label');
                jumlahProdukLabel.innerHTML = 'Jumlah Produk:';
                let subTotalLabel = document.createElement('label');
                subTotalLabel.innerHTML = 'Sub Total:';

                produkItem.appendChild(label);
                produkItem.appendChild(jumlahProdukLabel);
                produkItem.appendChild(jumlahProdukInput);
                produkItem.appendChild(subTotalLabel);
                produkItem.appendChild(subTotalInput);
                produkDetails.appendChild(produkItem);
            }
        });
    });
</script>
@endsection
