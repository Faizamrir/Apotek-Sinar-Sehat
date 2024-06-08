<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use App\Http\Requests\StoresupplierRequest;
use App\Http\Requests\UpdatesupplierRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = supplier::all();
        return view('supplier', compact('suppliers'));
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
    public function store(StoresupplierRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'telp' => 'required|numeric',
        ]);

        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }else{
            $data = [
                'nama_supplier' => $request->get('nama_supplier'),
                'alamat' => $request->get('alamat'),
                'kota' => $request->get('kota'),
                'telp' => $request->get('telp')
            ];

            supplier::create($data);
            return redirect()->route('supplier.index')->with('success', 'Data Supplier berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplier = supplier::find($id);
        return $supplier;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesupplierRequest $request, supplier $supplier)
    {
        $validator = Validator::make($request->all(), [
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'telp' => 'required|numeric',
        ]);

        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        } else {
            $data = [
                'nama_supplier' => $request->get('nama_supplier'),
                'alamat' => $request->get('alamat'),
                'kota' => $request->get('kota'),
                'telp' => $request->get('telp')
            ];
        };

        supplier::where('id', $request->id)->update($data);
        return redirect()->route('supplier.index')->with('success', 'Data Supplier berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if(Auth::user()->is_admin == '1'){
            supplier::where('id', $id)->delete();
            return redirect()->route('supplier.index')->with('success', 'Data Supplier berhasil dihapus');
        }else{
            notify()->error('Penghapusan supplier ditolak');
            return redirect()->route('supplier.index');
        }
    }
}
