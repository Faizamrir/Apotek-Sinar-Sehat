<?php

namespace App\Http\Controllers;

use App\Models\satuan;
use App\Http\Requests\StoresatuanRequest;
use App\Http\Requests\UpdatesatuanRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $satuans = satuan::all();
        return view('satuan', compact('satuans'));
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
    public function store(StoresatuanRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'satuan' => 'required'
        ]);

        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }else{
            $data = [
                'satuan' => $request->get('satuan'),
            ];

            satuan::create($data);
            notify()->success('Data Satuan berhasil ditambahkan');
            return redirect()->route('satuan.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $satuan = satuan::find($id);
        return $satuan;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesatuanRequest $request, satuan $satuan)
    {
        $validator = Validator::make($request->all(), [
            'satuan' => 'required'
        ]);

        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        } else {
            $data = [
                'satuan' => $request->get('satuan')
            ];
        };

        satuan::where('id', $request->id)->update($data);
        notify()->success('Data Satuan berhasil diubah');
        return redirect()->route('satuan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if(Auth::user()->is_admin == '1'){
            satuan::where('id', $id)->delete();
            notify()->success('Data Satuan berhasil dihapus');
            return redirect()->route('satuan.index');
        }else{
            notify()->error('Penghapusan satuan ditolak');
            return redirect()->route('satuan.index');
        }
    }
}
