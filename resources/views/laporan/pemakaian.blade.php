<!DOCTYPE html>
<html>
    <head>
        <title>Laporan Pemaiakan Bulan {{ $date->isoFormat('MMM YYYY') }}</title>
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
        <h5>Laporan Pemakaian Bulan {{ $date->isoFormat('MMM YYYY') }}</h5>
        <h5>Apotek Sinar Sehat</h5>
    </center>
 
    <table class='table table-bordered'>
    <thead>
        <tr>
            <th>Nama Obat</th>
            <th>Jumlah Pemakaian</th>
            <th>satuan</th>
        </tr>
    </thead>
    <tbody>

    @foreach($pemakaian as $row)
    <tr>
        <td>{{$row->nama_obat}}</td>
        <td>{{$row->total_pemakaian}}</td>
        <td>{{isset($row->obat->satuan[0]) ? $row->obat->satuan[0]->satuan : ''}}</td>
    </tr>
    @endforeach
    </tbody>
    </table>
 
</body>
</html>