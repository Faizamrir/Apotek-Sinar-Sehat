<?php

namespace App\Http\Controllers;

use App\Exports\PemakaianExport;
use App\Models\Pemakaian;
use App\Models\Obat;
use App\Http\Requests\StorePemakaianRequest;
use App\Http\Requests\UpdatePemakaianRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PenjualanController;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Doctrine\CarbonType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Month;

class PemakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dateNow = Carbon::now();
        $pemakaian = Pemakaian::whereYear('created_at', $dateNow->year)
                                ->whereMonth('created_at', $dateNow->month)
                                ->select('nama_obat', DB::raw('SUM(jumlah) as total_pemakaian'))
                                ->groupBy('nama_obat')->get();
        return view('pemakaian', compact('pemakaian'));
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
    public function store($request)
    {
        // $validator = Validator::make($request->all(), [
        //     'nama_obat' => 'required',
        //     'jumlah_pemakaian' => 'required|numeric',
        // ]);

        // if($validator->fails()){
        //     return response()->json($validator->errors(), 422);
        // }else{
        //     
        // }
        $data = [
                    'nama_obat' => $request['obat'],
                    'jumlah' => $request['jumlah'],

                ];
        
        Pemakaian::create($data);
        // return redirect()->route('pemakaian.index')->with('success', 'Data pemakaian berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemakaian $pemakaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemakaian $pemakaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePemakaianRequest $request, Pemakaian $pemakaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemakaian $pemakaian)
    {
        //
    }

    public function cetak_laporan(Request $request){
        $dateString = $request->get('bulan');
        $date = Carbon::createFromFormat('Y-m', $dateString);
        
        // $pemakaian = Pemakaian::with('obat', 'obat.satuan')
        //                         ->whereYear('created_at', $date->year)
        //                         ->whereMonth('created_at', $date->month)
        //                         ->select('nama_obat','id_obat', DB::raw('SUM(jumlah) as total_pemakaian'))
        //                         ->groupBy('nama_obat')
        //                         ->orderBy('total_pemakaian', 'desc')
        //                         ->get();

        // $get = new PemakaianExport($date);
        // dd($get->query());

        if($date != null ){
            return (new PemakaianExport($date))->download('laporan-pemakaian-'.$date->monthName.'-'.$date->year.'.xlsx');
            // $laporan = PDF::loadView('laporan.pemakaian', compact('pemakaian', 'date'));
            // return $laporan->stream();
        }else{
            return redirect()->route('laporan')->with('error', 'Data tidak ditemukan');
        }
    }

    public function refactoring_database(){
        $obat = Obat::All();
        foreach($obat as $o){
            $pemakaian = Pemakaian::where('nama_obat', $o->nama_obat)
            ->update(['id_obat' => $o->id]);
        }
        return true;
    }

}
