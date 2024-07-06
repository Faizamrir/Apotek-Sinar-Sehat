<!DOCTYPE html>
<html>
    <head>
        <title>Laporan Penjualan Harian {{ $tgl->isoFormat('D MMM YYYY') }}</title>
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
        <h5>Laporan Penjualan Harian {{ $tgl->isoFormat('D MMM YYYY') }}</h5>
        <h5>Apotek Sinar Sehat</h5>
    </center>   


    
    @foreach($transaksi_perakun as $nama_akun => $transaksis)
    @php
        $total = 0;
    @endphp
    <table class='table table-bordered'>
    <thead>
        <tr>
            <th>Tgl Transaksi</th>
            <th>Nama Obat</th>
            <th>Jumlah</th>
            <th>nama_akun</th>
            <th>Subotal</th>
        </tr>
    </thead>
    <tbody>
    @foreach($transaksis as $penjualan)
        @foreach($penjualan->detail_penjualan as $detail)
            <tr>
                <td>{{$penjualan->created_at}}</td>
                <td>{{$detail->obat->nama_obat}}</td>
                <td>{{$detail->jumlah}}</td>
                <td>{{$penjualan->nama_akun}}</td>
                <td>{{$detail->subtotal}}</td>
            </tr>
            @php
            $total += $detail->subtotal;
            @endphp
        @endforeach
    @endforeach
    <tr>
        <td colspan="4" align="right">Total</td>
        <td>{{$total}}</td>
    </tr>
    </tbody>
    </table>
    @endforeach
 
    {{-- <br>
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
            @foreach($penjualan->detail_penjualan as $detail)
                <tr>
                    <td>{{$penjualan->created_at}}</td>
                    <td>{{$detail->obat->nama_obat}}</td>
                    <td>{{$detail->jumlah}}</td>
                    <td>{{$detail->subtotal}}</td>
                </tr>
            @endforeach
        @endforeach
        <tr>
            <td colspan="3" align="right">Total</td>
            <td>{{$totals}}</td>
        </tr>
        </tbody>
        </table> --}}

</body>
</html>