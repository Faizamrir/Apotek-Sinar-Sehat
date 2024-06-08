<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class satuan extends Model
{
    use HasFactory;

    function obat(){
        return $this->belongsTo(Obat::class, 'id_satuan', 'id');
    }

    protected $fillable = [
        'satuan'
    ];
}
