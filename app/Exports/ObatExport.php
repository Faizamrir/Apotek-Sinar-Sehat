<?php

namespace App\Exports;

use App\Models\Obat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;


class ObatExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Nama Obat',
            'Satuan',
            'Supplier',
            'Harga',
            'Stok'
        ];
    }

    public function collection()
    {
        $obats = Obat::with('satuan', 'supplier')
            ->orderBy('nama_obat', 'asc')
            ->get()
            ->filter(function ($obat) {
                return $obat->stok === 0 || $obat->stok > 0;
            })
            ->map(function ($obat) {
                return [
                    'nama_obat' => $obat->nama_obat,
                    'satuan' => $obat->satuan[0]->satuan ?? null,
                    'nama_supplier' => $obat->supplier[0]->nama_supplier ?? null,
                    'harga' => $obat->harga,
                    'stok' => $obat->stok !== null ? (string)$obat->stok : 0,
                ];
            });
        return $obats;
    }
}
