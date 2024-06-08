<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class return_pembelian extends Model
{
    use HasFactory;

    public function detail_return_pembelian(){
        return $this->hasMany(detail_return_pembelian::class, 'id_return_pembelian', 'id');
    }

    protected $fillable = [
        'id',
        'no_faktur',
    ];
}
