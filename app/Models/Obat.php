<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Obat extends Model
{
    use HasFactory;

    function satuan(){
        return $this->hasMany(Satuan::class, 'id', 'id_satuan');
    }

    function supplier(){
        return $this->hasMany(Supplier::class, 'id', 'id_supplier');
    }

    function detail_pembelian(){
        return $this->hasMany(detail_pembelian::class, 'id_obat', 'id');
    }

    function detail_return_pembelian(){
        return $this->hasMany(detail_return_pembelian::class, 'id_obat', 'id');
    }

    function penjualan(){
        return $this->hasMany(detail_penjualan::class, 'id_obat', 'id');
    }

    function pemakaian(){
        return $this->hasMany(Pemakaian::class, 'id_obat', 'id');
    }

    protected $fillable = [
        'nama_obat',
        'stok',
        'harga',
        'id_satuan',
        'id_supplier',
        'expired',
    ];
}
