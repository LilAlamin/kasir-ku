<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            margin-top: 20px;
            float: right;
        }
    </style>
</head>
<body>
    <h1>Kasirku</h1>
    <h2>Nota Penjualan</h2>
    <p>Nomor Transaksi: {{ $data['nomor_transaksi'] }}</p>
    <p>Tanggal Transaksi: {{ $data['tanggal_transaksi'] }}</p>
    <p>Nama Pelanggan: {{$data['nama_pelanggan']}}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @forelse ($data['details'] as $index => $detail)
                @php
                    $subtotal = $detail->jumlah_produk * $detail->produk->harga;
                    $total += $subtotal;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->produk->nama_produk }}</td>
                    <td>{{ $detail->jumlah_produk }}</td>
                    <td>Rp. {{ number_format($detail->produk->harga, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($subtotal, 0, ',', '.') }}</td>
                    
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada detail penjualan tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <p>*Barang yang sudah dibeli tidak dapat dikembalikan.</p>


    <div class="total">
        <p>Total Harga: Rp. {{ number_format($total, 0, ',', '.') }}</p>
    </div>
</body>
</html>
