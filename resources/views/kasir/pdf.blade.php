<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Penjualan</title>
    <style>
        /* Tambahkan CSS sesuai dengan kebutuhan Anda untuk tampilan PDF */
    </style>
</head>
<body>
    <h1>Nota Penjualan</h1>
    <p>Nomor Transaksi: {{ $data['nomor_transaksi'] }}</p>
    <p>Tanggal Transaksi: {{ $data['tanggal_transaksi'] }}</p>
    <p>Nama Pelanggan: {{$data['nama_pelanggan']}}</p>
    <p>Total Harga: {{$data['total_harga'] }}</p>

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
            @forelse ($data['details'] as $index => $detail)

                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->produk->nama_produk }}</td>
                    <td>{{ $detail->jumlah_produk }}</td>
                    <td>{{ $detail->produk->harga }}</td>
                    <td>{{ $detail->sub_total }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada detail penjualan tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
