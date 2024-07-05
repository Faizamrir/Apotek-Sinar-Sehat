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

    public function get_faktur_all(Request $request){
        $faktur = pembelian::get();
        if ($request->has('q')) {
            $faktur = pembelian::where('no_faktur', 'like', '%' . $request->q . '%')->get();
            return response()->json($faktur);
        }
    }

    public function get_faktur_by_id(Request $request){
        $faktur = pembelian::with('detail_pembelian', 'detail_pembelian.obat')->where('no_faktur', $request->id)->get();
        return response()->json($faktur);
    }
}
