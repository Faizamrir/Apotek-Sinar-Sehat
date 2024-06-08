<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;

    function obat(){
        return $this->belongsTo(Obat::class, 'id_supplier', 'id');
    }

    function pembelian(){
        return $this->hasMany(pembelian::class, 'id_supplier', 'id');
    }

    protected $fillable = [
        'nama_supplier',
        'alamat',
        'kota',
        'telp'
    ];
}
