<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_return_pembelian extends Model
{
    use HasFactory;

    public function return_pembelian(){
        return $this->belongsTo(return_pembelian::class, 'id', 'id_return_pembelian');
    }

    public function obat(){
        return $this->belongsTo(obat::class, 'id_obat', 'id');
    }

    protected $fillable = [
        'id_return_pembelian',
        'id_obat',
        'jumlah'
    ];
}
