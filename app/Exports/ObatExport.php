<?php

namespace App\Exports;

use App\Models\Obat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;



class ObatExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Nama Obat',
            'Satuan',
            'Harga',
            'Stok'
        ];
    }

    public function collection()
    {
        $obats = Obat::with('satuan')
            ->orderBy('nama_obat', 'asc')
            ->get()
            ->filter(function ($obat) {
                return $obat->stok === 0 || $obat->stok > 0;
            })
            ->map(function ($obat) {
                return [
                    'nama_obat' => $obat->nama_obat,
                    'satuan' => $obat->satuan[0]->satuan ?? null,
                    'harga' => $obat->harga,
                    'stok' => $obat->stok !== null ? (string)$obat->stok : 0,
                ];
            });
        return $obats;
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow(); // Get the last row number
        $highestColumn = $sheet->getHighestColumn(); // Get the last column

        // Apply borders to all cells
        $sheet->getStyle('A1:' . $highestColumn . $highestRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 35, // Nama Obat
            'B' => 10, // Satuan
            'C' => 12, // Harga
            'D' => 8,  // Stok
        ];
    }
}
