@extends('layouts.kasir')

@section('layout')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('error'))
            <div id="errorAlert" class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <script>
                setTimeout(function() {
                    var errorAlert = document.getElementById('errorAlert');
                    if (errorAlert) {
                        errorAlert.style.display = 'none';
                    }
                }, 2000);
            </script>

            <div class="card">
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
                        <div class="form-group">
                            <label for="produk_details">Detail Produk:</label>
                            <div id="produk-details"></div>
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
    .produk-item {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
    }
    .selected {
        background-color: #007bff !important;
        color: #fff;
    }
</style>
<script>
   document.addEventListener('DOMContentLoaded', function() {
    const produkSelect = document.getElementById('produk_id');
    const produkDetails = document.getElementById('produk-details');
    const totalHargaInput = document.getElementById('total_harga');

    // Fungsi untuk menambahkan atau menghapus kelas 'selected' pada card
    function toggleCardSelection(card) {
        card.classList.toggle('selected');
    }

    // Fungsi untuk mengatur opsi produk terpilih berdasarkan card yang diklik
    function toggleOptionSelection(option) {
        option.selected = !option.selected;
    }

    // Menambahkan event listener pada setiap card produk
    const produkCards = document.querySelectorAll('.card.produk-item');
    produkCards.forEach(function(card) {
        card.addEventListener('click', function() {
            toggleCardSelection(card);
            const index = parseInt(card.getAttribute('data-index'));
            const option = produkSelect.options[index];
            toggleOptionSelection(option);
        });
    });

    // Menangani perubahan pada opsi produk yang dipilih
    produkSelect.addEventListener('change', function() {
        let selectedOptions = produkSelect.selectedOptions;
        produkDetails.innerHTML = ''; // Bersihkan detail produk sebelum menambahkan yang baru
        let totalHarga = 0;

        for (let option of selectedOptions) {
            let hargaAwal = parseFloat(option.getAttribute('data-harga'));

            let produkItem = document.createElement('div');
            produkItem.classList.add('card', 'produk-item');
            produkItem.setAttribute('data-index', option.index); // Menambahkan atribut untuk menyimpan indeks opsi

            let cardBody = document.createElement('div');
            cardBody.classList.add('card-body');

            let label = document.createElement('h5');
            label.classList.add('card-title');
            label.textContent = option.text;

            let hargaText = document.createElement('p');
            hargaText.classList.add('card-text');
            hargaText.textContent = 'Harga: Rp. ' + hargaAwal.toFixed(2);

            let jumlahProdukInput = document.createElement('input');
            jumlahProdukInput.setAttribute('type', 'number');
            jumlahProdukInput.setAttribute('name', 'jumlah_produk[]');
            jumlahProdukInput.setAttribute('class', 'form-control');
            jumlahProdukInput.setAttribute('placeholder', 'Jumlah Produk');
            jumlahProdukInput.setAttribute('min', '1'); // Set nilai minimum ke 1

            let subTotalInput = document.createElement('input');
            subTotalInput.setAttribute('type', 'text');
            subTotalInput.setAttribute('name', 'sub_total[]');
            subTotalInput.setAttribute('class', 'form-control');
            subTotalInput.setAttribute('readonly', 'readonly');

            jumlahProdukInput.addEventListener('input', function() {
                let jumlahProduk = parseFloat(jumlahProdukInput.value);
                if (jumlahProduk < 1) { // Validasi jika jumlah produk kurang dari 1
                    jumlahProdukInput.value = 1;
                    jumlahProduk = 1;
                }
                let subTotal = hargaAwal * jumlahProduk;
                subTotalInput.value = subTotal.toFixed(2);

                totalHarga = 0;
                document.querySelectorAll('[name="sub_total[]"]').forEach(input => {
                    totalHarga += parseFloat(input.value);
                });
                totalHargaInput.value = totalHarga.toFixed(2);
            });

            cardBody.appendChild(label);
            cardBody.appendChild(hargaText);
            cardBody.appendChild(jumlahProdukInput);
            cardBody.appendChild(subTotalInput);
            produkItem.appendChild(cardBody);
            produkDetails.appendChild(produkItem);
        }
    });

    // Menangani pengiriman formulir
    const checkoutButton = document.querySelector('form button[type="submit"]');
    checkoutButton.addEventListener('click', function(event) {
        const jumlahProdukInputs = document.querySelectorAll('[name="jumlah_produk[]"]');
        let isInvalid = false;
        jumlahProdukInputs.forEach(function(input) {
            if (parseFloat(input.value) === 0) {
                isInvalid = true;
            }
        });
        if (isInvalid) {
            event.preventDefault(); // Mencegah pengiriman formulir jika ada jumlah produk yang 0
            alert('Jumlah produk tidak boleh 0');
        }
    });
});


</script>
@endsection
