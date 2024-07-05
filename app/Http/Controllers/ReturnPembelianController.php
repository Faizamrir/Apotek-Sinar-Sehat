<?php

namespace App\Http\Controllers;

use App\Models\detail_return_pembelian;
use App\Models\Obat;
use App\Models\return_pembelian;
use App\Models\supplier;
use App\Http\Requests\Storereturn_pembelianRequest;
use App\Http\Requests\Updatereturn_pembelianRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReturnPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obats = Obat::all();
        $suppliers = supplier::all();
        return view('return-pembelian', compact('suppliers', 'obats'));
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
    public function store(Storereturn_pembelianRequest $request)
    {
        $data_pengembalian = [
            'no_faktur' => $request->no_faktur,
            'tgl_return' => Carbon::now(),
            'nama_akun' => Auth::user()->name,
        ];

        $pengembanlian = return_pembelian::create($data_pengembalian);

        $detail_pengembalian = $request->get('table_data');

        foreach ($detail_pengembalian as $data) {
            detail_return_pembelian::create([
                'id_return_pembelian' => $pengembanlian->id,
                'id_obat' => $data['id_obat'],
                'jumlah' => $data['jumlah'],
            ]);

            $obat = Obat::find($data['id_obat']);
            $obat->stok = $obat->stok - $data['jumlah'];
            $obat->save();
        }

        notify()->success('Pengembalian obat berhasil');
        return redirect()->route('returnpembelian.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(return_pembelian $return_pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(return_pembelian $return_pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatereturn_pembelianRequest $request, return_pembelian $return_pembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(return_pembelian $return_pembelian)
    {
        //
    }
}
