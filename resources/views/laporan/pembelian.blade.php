<!DOCTYPE html>
<html>
    <head>
        <title>Laporan Penjualan Bulan </title>
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
        <h5>Laporan Penjualan Bulan</h5>
        <h5>Apotek Sinar Sehat</h5>
    </center>
    <br>

    @if($pembelian_lunas->isnotEmpty())
    <div>
        <h6>Pembelian Lunas</h6>
    </div>
    <table class='table table-bordered'>
    <thead>
        <tr>
            <th>Tgl Pembelian</th>
            <th>No Faktur</th>
            <th>Nama Supplier</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>

    @foreach($pembelian_lunas as $pembelian)
    <tr>
        <td>{{$pembelian->created_at}}</td>
        <td>{{$pembelian->no_faktur}}</td>
        <td>{{$pembelian->supplier->nama_supplier}}</td>
        <td>{{$pembelian->total}}</td>
    </tr>
    @endforeach
    <tr>
        <td colspan="3" align="right">Total</td>
        <td>{{$total_lunas}}</td>
    </tr>
    </tbody>
    </table>
    <br>
 @endif

 @if($pembelian_belum_lunas->isnotEmpty())
    <div>
        <h6>Pembelian Belum Lunas</h6>
    </div>
    <table class='table table-bordered'>
    <thead>
        <tr>
            <th>Tgl Pembelian</th>
            <th>No Faktur</th>
            <th>Nama Supplier</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>

    @foreach($pembelian_belum_lunas as $pembelian)
    <tr>
        <td>{{$pembelian->created_at}}</td>
        <td>{{$pembelian->no_faktur}}</td>
        <td>{{$pembelian->supplier->nama_supplier}}</td>
        <td>{{$pembelian->total}}</td>
    </tr>
    @endforeach
    <tr>
        <td colspan="3" align="right">Total</td>
        <td>{{$total_belum_lunas}}</td>
    </tr>
    </tbody>
    </table>
 @endif

</body>
</html>