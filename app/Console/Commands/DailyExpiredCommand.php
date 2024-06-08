<?php

namespace App\Console\Commands;

use App\Models\Obat;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DailyExpiredCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-expired-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for daily expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $notificationDate = Carbon::now()->subMonth();
        $obat = Obat::whereDate('expired', '=', $notificationDate->toDateString())->get();
        $obat->notify()->warning( count($obat) + ' Obat akan kadaluarsa');
        $this->info(count($obat) + ' Obat akan kadaluarsa');
    }
}
