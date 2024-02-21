<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
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
    <h1>Laporan Penjualan</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Petugas Kasir</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan as $key => $penjualans)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $penjualans->user->username }}</td>
                    <td>{{ $penjualans->created_at ? $penjualans->created_at->isoFormat('dddd, D MMMM YYYY / H:mm:ss') : '' }}</td>
                    <td>{{ $penjualans->nama_pelanggan }}</td>
                    <td>Rp. {{ number_format($penjualans->total_harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
