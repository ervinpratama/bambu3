<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table th {
            padding:5px;
        }

        table td {
            padding:5px;
        }

        tfoot {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h3>Laporan Penjualan Barang</h3>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <td>Tanggal Transaksi</td>
                <th>Order ID</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
                $jumlah = 0;
            @endphp
            @foreach ($list as $data)
            @php
                $jumlah += $data->qty;
                $total += $data->qty * $data->price;
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ date('d-m-Y', strtotime($data->transaction_date)) }}</td>
                <td>{{ $data->order_id }}</td>
                <td>{{ $data->nama_barang }}</td>
                <td>Rp {{ number_format($data->price,0,',','.') }}</td>
                <td align="center">{{ $data->qty }}</td>
                <td>Rp {{ number_format($data->qty * $data->price,0,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">TOTAL</td>
                <td align="center">{{ $jumlah }}</td>
                <td>Rp {{ number_format($total,0,',','.') }}</td>
            </tr>
        </tfoot>
    </table>
    

    
</body>
</html>