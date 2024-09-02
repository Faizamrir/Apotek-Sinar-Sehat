<?php

namespace App\Exports;

use App\Models\detail_pembelian;
use App\Models\detail_penjualan;
use App\Models\Penjualan;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PenjualanExport implements FromArray, ShouldAutoSize
{

    protected $startDate;
    protected $endDate;
    protected $days;

    public function __construct($date)
    {
        // Convert input date to Carbon and get start and end of the month
        $carbonDate = Carbon::parse($date);
        $this->endDate = $carbonDate->endOfMonth();
        $this->startDate = $carbonDate->copy()->startOfMonth();
        
        
        // Calculate total days in the month
        $this->days = $this->startDate->daysInMonth;
    }

    public function array(): array
    {
        $data = [];

    // Loop through each day of the month
    for ($day = 1; $day <= $this->days; $day++) {
        $currentDate = $this->startDate->copy()->addDays($day - 1);

        // Fetch transactions for the current day
        $transactions = detail_penjualan::with('obat.satuan')->whereDate('created_at', $currentDate)->get();

        // Only add data if there are transactions for the current day
        if ($transactions->isNotEmpty()) {
            // Group transactions by 'Nama Obat' and sum 'Jumlah' and 'Subtotal'
            $groupedTransactions = $transactions->groupBy('obat.nama_obat')->map(function ($rows) {
                $firstRow = $rows->first();
                return [
                    'satuan' => $firstRow->obat->satuan->first()->satuan,  // Assuming there is always at least one 'satuan'
                    'harga' => $firstRow->obat->harga, // Assuming 'harga' is the same for all
                    'jumlah' => $rows->sum('jumlah'),
                    'subtotal' => $rows->sum('subtotal'),
                ];
            });

            // Add a date heading for the day
            $data[] = ["Tanggal", $currentDate->format('d/m/Y'), '', ''];

            // Add column headings for the transactions
            $data[] = ['Tanggal Transaksi', 'Nama Obat', 'Satuan', 'Harga', 'Jumlah', 'Subtotal'];

            // Initialize total for the day
            $dailyTotal = 0;

            // Add each grouped transaction to the data array
            foreach ($groupedTransactions as $namaObat => $details) {
                $data[] = [
                    $currentDate->format('Y-m-d'),  // Use the same date for all transactions on the day
                    $namaObat,
                    $details['satuan'],
                    $details['harga'],
                    $details['jumlah'],
                    $details['subtotal'],
                ];
                $dailyTotal += $details['subtotal'];
            }

            // Add the total row for the day
            $data[] = ['', '', '', '', 'Total', $dailyTotal];

            // Add an empty row to separate days (optional)
            $data[] = ['', '', '', '', '', ''];
        }
    }

    return $data;
    }

}
