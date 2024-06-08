<!DOCTYPE html>
<html>
    <head>
        <title>Laporan Penjualan Bulan {{ $penjualans[0]->created_at->isoFormat('MMM YYYY') }}</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
<body>
    <style type="text/css">
        table tr td,
        table tr th{
        font-size: 9pt;
        }
    </style>

    <center>
        <h5>Laporan Penjualan Bulan {{ $penjualans[0]->created_at->isoFormat('MMMM YYYY') }}</h5>
        <h5>Apotek Sinar Sehat</h5>
    </center>
 
    <table class='table table-bordered'>
    <thead>
        <tr>
            <th>Tgl Transaksi</th>
            <th>Nama Obat</th>
            <th>Jumlah</th>
            <th>Subotal</th>
        </tr>
    </thead>
    <tbody>

    @foreach($penjualans as $penjualan)
    <tr>
        <td>{{$penjualan->created_at}}</td>
        <td>{{$penjualan->obat}}</td>
        <td>{{$penjualan->jumlah}}</td>
        <td>{{$penjualan->total}}</td>
    </tr>
    @endforeach
    <tr>
        <td colspan="3" align="right">Total</td>
        <td>{{$totals}}</td>
    </tr>
    </tbody>
    </table>
 
</body>
</html>