<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    use HasFactory;

    function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat', 'id');
    }

    protected $fillable = [
        'nama_obat',
        'jumlah',
        'id_obat',
    ];
}
