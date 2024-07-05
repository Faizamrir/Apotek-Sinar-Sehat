<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_penjualan extends Model
{
    use HasFactory;
    
    public function penjualan(){
        return $this->belongsTo(penjualan::class, 'id_penjualan', 'id');
    }

    public function obat(){
        return $this->belongsTo(obat::class, 'id_obat', 'id');
    }

    protected $fillable = [
        'id_penjualan',
        'id_obat',
        'harga',
        'jumlah',
        'subtotal'
    ];
}
