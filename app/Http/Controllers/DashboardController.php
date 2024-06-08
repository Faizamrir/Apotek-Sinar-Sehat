<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\pembelian;
use App\Models\penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;



class DashboardController extends Controller
{
    public function index()
    {
        $expired_date = $this->check_expired();
        $penjualan = $this->check_penjualan();
        $jatuh_tempo = $this->check_jatuh_tempo();
        return view('dashboard', compact('expired_date', 'penjualan', 'jatuh_tempo'));
    }

    public function check_expired(){
        $expired_date = Carbon::now()->addMonth();
        $expired = Obat::whereDate('expired', '<', $expired_date)->orderBy('expired', 'asc')->get();
        return $expired;
    }

    public function check_penjualan(){
        $penjualan = penjualan::whereDate('created_at', Carbon::today())->sum('total');
        return $penjualan;
    }

    public function check_jatuh_tempo(){
        $jatuh_tempo_date = Carbon::now()->addMonth();
        $jatuh_tempo = pembelian::whereDate('jatuh_tempo', '<', $jatuh_tempo_date)->where('status_lunas', false)->orderBy('jatuh_tempo', 'asc')->get();
        return $jatuh_tempo;
    }
}
