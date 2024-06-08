<?php

namespace App\Http\Controllers;

use App\Models\penjualan;
use App\Http\Requests\StorepenjualanRequest;
use App\Http\Requests\UpdatepenjualanRequest;
use App\Models\Obat;
use Barryvdh\DomPDF\Facade\Pdf;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $get_obat = Obat::all();
        $penjualans = penjualan::all()->where('nama_akun', Auth::user()->name)->where('created_at', '>=' , Carbon::today());
        $totals = penjualan::all()->where('nama_akun', Auth::user()->name)->where('created_at', '>=' , Carbon::today())->sum('total');
        return view('penjualan', compact('penjualans', 'get_obat', 'totals'));
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
        $validator = Validator::make($request->all(), [
            'obat' => 'required',
            'jumlah' => 'required|numeric',
            'total' => 'required|numeric',
            'nama_akun' => 'required',
        ]);

        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }else{
            $data = [
                'obat' => $request->get('obat'),
                'jumlah' => $request->get('jumlah'),
                'total' => $request->get('total'),
                'nama_akun' => $request->get('nama_akun'),
            ];
        }


        $pemakaian = new PemakaianController;
        $pemakaian = $pemakaian->store($data);

        $obat = Obat::where('nama_obat', $request->get('obat'))->first();
        if(!empty($obat) && $obat->stok >= $request->get('jumlah')) {
            $obat->stok = $obat->stok - $request->get('jumlah');
            $obat->save();
        }else{
            notify()->warning('Stok obat tidak mencukupi');
            return redirect()->route('penjualan.index');
        }

        penjualan::create($data);
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
        $tgl = Carbon::createFromFormat('Y-m-d', $request->get('tgl'));
        $penjualans = penjualan::whereDate('created_at', '=', $tgl)->get();
        $totals = penjualan::all()->where('created_at', '=' , $tgl)->sum('total');

        if($penjualans->isNotEmpty()){
            $laporan = PDF::loadView('laporan.penjualan', compact('penjualans', 'totals'));
            return $laporan->stream();
        } else {
            return redirect()->route('laporan')->with('error', 'Data tidak ditemukan');
        }
    }

    public function cetak_laporan_bulanan(Request $request){
        $dateString = $request->get('bulan');
        $date = Carbon::createFromFormat('Y-m', $dateString);
        $penjualans = penjualan::whereYear('created_at', $date->year)
                                ->whereMonth('created_at', $date->month)
                                ->get();

        $totals = penjualan::whereYear('created_at', $date->year)
                                ->whereMonth('created_at', $date->month)
                                ->sum('total');

        if($penjualans->isNotEmpty() ){
            $laporan = PDF::loadView('laporan.penjualan-bulanan', compact('penjualans', 'totals'));
            return $laporan->stream();
        } else {
            return redirect()->route('laporan')->with('error', 'Data tidak ditemukan');
        }
    }
}