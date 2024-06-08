<?php

namespace App\Http\Controllers;

use App\Models\pembelian;

use Illuminate\Http\Request;

class FakturController extends Controller
{
    public function index()
    {
        $fakturs = pembelian::with('detail_pembelian', 'detail_pembelian.obat')->get();
        return view('faktur', compact('fakturs'));
    }

    public function faktur_lunas(Request $request){
        $faktur = pembelian::where('no_faktur', $request->no_faktur)->first();
        $faktur->status_lunas = true;
        $faktur->save();
        notify()->success('Faktur lunas');
        return redirect()->route('faktur.index');
    }
}
