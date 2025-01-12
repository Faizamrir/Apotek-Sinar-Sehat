<?php

namespace App\Http\Controllers;

use App\Models\penjualan;
use App\Exports\PenjualanExport;
use App\Http\Requests\StorepenjualanRequest;
use App\Http\Requests\UpdatepenjualanRequest;
use App\Models\Obat;
use App\Models\detail_penjualan;
use App\Models\Pemakaian;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\DomPDF\Facade\Pdf;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $get_obat = Obat::all()->sortBy('nama_obat');
        return view('penjualan', compact('get_obat'));
    }

    public function penjualanView(){
        return view('list-penjualan');
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
    public function store(StorepenjualanRequest $request)
    {
        
        $data_penjualan = [
            'uang_bayar' => $request->get('uang_bayar'),
            'total' => $request->get('total'),
            'uang_kembali' => $request->get('uang_kembali'),
            'nama_akun' => auth()->user()->name,
        ];

        $penjualan = penjualan::create($data_penjualan);

        $data_detail = $request->get('table_data');

        foreach ($data_detail as $data) {
            detail_penjualan::create([
                'id_penjualan' => $penjualan->id,
                'id_obat' => $data['id_obat'],
                'harga' => $data['harga'],
                'jumlah' => $data['jumlah'],
                'subtotal' => $data['subtotal'],
            ]);

            $obat = Obat::where('id', $data['id_obat'])->first();
            if($obat){
            $obat->stok = $obat->stok - $data['jumlah'];
            $obat->save();
            }

            $pemakaian = Pemakaian::create([
                'nama_obat' => $obat['nama_obat'],
                'jumlah' => $data['jumlah'],
                'id_obat' => $data['id_obat'],
            ]);
        };

        notify()->success('Data Penjualan berhasil ditambahkan');
        return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil ditambahkan');
  
    }

    /**
     * Display the specified resource.
     */
    public function show(penjualan $penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepenjualanRequest $request, penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(penjualan $penjualan)
    {
        //
    }

    public function pemakaianObat($bulan, $tahun)
    {
        return penjualan::whereYear('created_at', $tahun)
                        ->whereMonth('created_at', $bulan)
                        ->select('obat as nama_obat', DB::raw('SUM(jumlah) as total_pemakaian'))
                        ->groupBy('obat')->get();
    }

    public function cetak_laporan(Request $request){
        if(Auth::user()->is_admin == '1'){
        $tgl = Carbon::createFromFormat('Y-m-d', $request->get('tgl'));
        $akun = penjualan::whereDate('created_at', '=', $tgl)->distinct()->pluck('nama_akun');
        $transaksi_perakun = [];
        foreach($akun as $a){
            $penjualans = penjualan::with('detail_penjualan')->whereDate('created_at', '=', $tgl)->where('nama_akun', $a)->get();
            $transaksi_perakun[$a] = $penjualans;
        }
        $totals = penjualan::whereDate('created_at', '=', $tgl)->sum('total');
        if($penjualans->isNotEmpty()){
            $laporan = PDF::loadView('laporan.penjualan', compact('transaksi_perakun', 'totals', 'tgl'));
            return $laporan->stream();
        } else {
            return redirect()->route('laporan')->with('error', 'Data tidak ditemukan');
        }
        } else {
            notify()->error('Pengaksesan laporan ditolak');
            return redirect()->route('laporan');
        }
    }

    public function cetak_laporan_bulanan(Request $request){
        if(Auth::user()->is_admin == '1'){
        $dateString = $request->get('bulan');
        $date = Carbon::createFromFormat('Y-m', $dateString);
        // $date = Carbon::createFromFormat('Y-m', $dateString);
        // dd($date->daysInMonth);
        // $penjualans = penjualan::with('detail_penjualan')->whereYear('created_at', $date->year)
        //                         ->whereMonth('created_at', $date->month)
        //                         ->get();
                                
        // Storage::disk('public')->put('data.json', json_encode($penjualans));

        // dd($penjualans);

        
        // $totals = penjualan::whereYear('created_at', $date->year)
        //                         ->whereMonth('created_at', $date->month)
        //                         ->sum('total');


        if($dateString != null ){
            // $laporan = PDF::loadView('laporan.penjualan-bulanan', compact('penjualans', 'totals'));
            // return $laporan->stream('laporan-penjualan-bulanan.pdf');
            return Excel::download(new PenjualanExport($dateString), 'laporan-penjualan-bulan-'.$date->monthName.'-'.$date->year.'.xlsx');
        } else {
            return redirect()->route('laporan')->with('error', 'Data tidak ditemukan');
        }
        } else {
            notify()->error('Pengaksesan laporan ditolak');
            return redirect()->route('laporan');
        }
    }
}
