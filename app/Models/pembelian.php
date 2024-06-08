<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembelian extends Model
{
    use HasFactory;

    public function detail_pembelian(){
        return $this->hasMany(detail_pembelian::class, 'id_pembelian', 'id');
    }

    public function supplier(){
        return $this->belongsTo(supplier::class, 'id_supplier', 'id');
    }

    protected $fillable = [
        'no_faktur',
        'id_supplier',
        'tgl_transaksi',
        'diskon',
        'ppn',
        'status_lunas',
        'jatuh_tempo',
        'total',
        'penerima'
    ];
}
