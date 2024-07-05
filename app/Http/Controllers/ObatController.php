<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\satuan;
use App\Models\supplier;
use App\Http\Controllers\PenjualanController;
use App\Http\Requests\StoreObatRequest;
use App\Http\Requests\UpdateObatRequest;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */


    public function index()
    {
        $obats = Obat::with('satuan', 'supplier')->get();
        $get_satuan = satuan::all();
        $get_supplier = supplier::all();
        // notify()->success('Obat sudah kadaluarsa');
        
        return view('obat', compact('obats', 'get_satuan', 'get_supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($data)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreObatRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_obat' => 'required',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'expired' => 'required',
        ]);

        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }else{
            $data = [
                'nama_obat' => $request->get('nama_obat'),
                'stok' => $request->get('stok'),
                'harga' => $request->get('harga'),
                'id_satuan' => $request->get('id_satuan'),
                'expired' => $request->get('expired'),
                'id_supplier' => $request->get('id_supplier')
            ];

            Obat::create($data);
            notify()->success('Data obat berhasil ditambahkan');
            return redirect()->route('obat.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $obat = Obat::all();
        return $obat;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $obat = Obat::find($id);
        return $obat;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateObatRequest $request, Obat $obat)
    {
        $validator = Validator::make($request->all(), [
            'nama_obat' => 'required',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'expired' => 'required',
        ]);

        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        } else {
            $data = [
                'nama_obat' => $request->get('nama_obat'),
                'stok' => $request->get('stok'),
                'harga' => $request->get('harga'),
                'id_satuan' => $request->get('id_satuan'),
                'expired' => $request->get('expired'),
                'id_supplier' => $request->get('id_supplier')
            ];
        };

        Obat::where('id', $request->id)->update($data);
        notify()->success('Data obat berhasil diubah');
        return redirect()->route('obat.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if(Auth::user()->is_admin == '1'){
            Obat::where('id', $id)->delete();
            notify()->success('Data obat berhasil dihapus');
            return redirect()->route('obat.index');
        }else{
            notify()->error('Penghapusan obat ditolak');
            return redirect()->route('obat.index');
        }
        
    }

    public function check_expired(Schedule $schedule){
        $schedule->call(function () {
            Obat::where('expired', '<', date('Y-m-d'));
            notify()->warning('Obat sudah kadaluarsa');
        })->daily();
        $obat = Obat::where('expired', '<', date('Y-m-d'))->get();
        notify()->warning('Obat sudah kadaluarsa');
        return Redirect::index();
    }

}
