<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjualan extends Model
{
    use HasFactory;

    public function detail_penjualan(){
        return $this->hasMany(detail_penjualan::class, 'id_penjualan', 'id');
    }

    protected $fillable = [
        'uang_bayar',
        'uang_kembali',
        'total',
        'nama_akun',
    ];
}
