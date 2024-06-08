<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_pembelian extends Model
{
    use HasFactory;

    public function pembelian(){
        return $this->belongsTo(pembelian::class, 'id', 'id_pembelian');
    }
    
    public function obat(){
        return $this->belongsTo(obat::class, 'id_obat', 'id');
    }

    protected $fillable = [
        'id_pembelian',
        'id_obat',
        'harga',
        'diskon',
        'jumlah',
        'subtotal'
    ];
}
