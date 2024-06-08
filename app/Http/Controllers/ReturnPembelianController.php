<?php

namespace App\Http\Controllers;

use App\Models\return_pembelian;
use App\Http\Requests\Storereturn_pembelianRequest;
use App\Http\Requests\Updatereturn_pembelianRequest;

class ReturnPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('return-pembelian');
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
        //
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
