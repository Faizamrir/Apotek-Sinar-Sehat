<?php

namespace App\Http\Controllers;

use App\Models\detail_pembelian;
use App\Models\pembelian;
use App\Http\Requests\StorepembelianRequest;
use App\Http\Requests\UpdatepembelianRequest;
use App\Models\supplier;
use App\Models\Obat;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $get_suppliers = supplier::all();
        $get_obat = Obat::all();
        return view('pembelian', compact('get_suppliers', 'get_obat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepembelianRequest $request)
    {
        $datatable = $request->input('table_data');
        $id_supplier = $request->input('id_supplier');
        $tgl_transaksi = $request->input('tgl_transaksi');
        $jatuh_tempo = $request->input('jatuh_tempo');
        $diskon = $request->input('diskon');
        $ppn = $request->input('total') * 0.1;
        $total = $request->input('total') + $ppn - $diskon;
        $no_faktur = $request->input('no_faktur');

        if(is_null($diskon)){
            $diskon = 0;
        }

        $id_pembelian = pembelian::create([
            'no_faktur' => $no_faktur,
            'id_supplier' => $id_supplier,
            'tgl_transaksi' => $tgl_transaksi,
            'diskon' => $diskon,
            'ppn' => $ppn,
            'penerima' => Auth::user()->name,
            'jatuh_tempo' => $jatuh_tempo,
            'total' => $total
        ]);

        foreach ($datatable as $data) {
            detail_pembelian::create([
                'id_pembelian' => $id_pembelian->id,
                'id_obat' => $data['id_obat'],
                'harga' => $data['harga'],
                'jumlah' => $data['jumlah'],
                'diskon' => $data['diskon'],
                'subtotal' => $data['subtotal']
            ]);

            $obat = Obat::where('id', $data['id_obat'])->first();
            if($obat){
            $obat->stok = $obat->stok + $data['jumlah'];
            $obat->save();
        }
        };

        
        notify()->success('Data Pembelian berhasil ditambahkan');
        return redirect()->route('pembelian.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(pembelian $pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pembelian $pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepembelianRequest $request, pembelian $pembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pembelian $pembelian)
    {
        //
    }


    public function cetak_laporan(Request $request){
        $dateString = $request->get('bulan');
        $date = Carbon::createFromFormat('Y-m', $dateString);
        $pembelian_lunas = pembelian::whereYear('created_at', $date->year)
                                ->whereMonth('created_at', $date->month)
                                ->where('status_lunas', true)
                                ->get();

        $total_lunas = pembelian::whereYear('created_at', $date->year)
                            ->whereMonth('created_at', $date->month)
                            ->where('status_lunas', true)
                            ->sum('total');

        $pembelian_belum_lunas = pembelian::whereYear('created_at', $date->year)
                            ->whereMonth('created_at', $date->month)
                            ->where('status_lunas', false)
                            ->get();

        $total_belum_lunas = pembelian::whereYear('created_at', $date->year)
                            ->whereMonth('created_at', $date->month)
                            ->where('status_lunas', false)
                            ->sum('total');

        if($pembelian_lunas->isNotEmpty() || $pembelian_belum_lunas->isNotEmpty()){
            $laporan = PDF::loadView('laporan.pembelian', compact('pembelian_lunas', 'total_lunas', 'pembelian_belum_lunas', 'total_belum_lunas'));
            return $laporan->stream();
        } else {
            return redirect()->route('laporan')->with('error', 'Data tidak ditemukan');
        }
    }
   
}
