<?php

namespace App\Exports;

use App\Models\Pemakaian;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PemakaianExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;
    protected $tanggal;

    public function __construct($tanggal)
    {
        $this->tanggal = $tanggal;
    }

    public function headings(): array
    {
        return ['Nama Obat', 'Total Pemakaian', 'Satuan'];
    }

    public function collection()
    {
        

        $pemakaian = Pemakaian::query()
            ->join('obats', 'pemakaians.id_obat', '=', 'obats.id')
            ->join('satuans', 'obats.id_satuan', '=', 'satuans.id')
            ->whereYear('pemakaians.created_at', $this->tanggal->year)
            ->whereMonth('pemakaians.created_at', $this->tanggal->month)
            ->select(
                'obats.nama_obat',
                DB::raw('SUM(pemakaians.jumlah) as total_pemakaian'),
                'satuans.satuan'
            )
            ->groupBy('obats.nama_obat', 'satuans.satuan')
            ->orderBy('nama_obat', 'asc')
            ->get();

            return $pemakaian;
    }

}
