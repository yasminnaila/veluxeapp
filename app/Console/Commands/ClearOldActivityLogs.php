<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ActivityLog;
use Carbon\Carbon;

class ClearOldActivityLogs extends Command
{
    protected $signature = 'logs:clear-old';
    protected $description = 'Hapus activity log yang lebih dari 3 bulan';

    public function handle()
    {
        $deleted = ActivityLog::where('created_at', '<', Carbon::now()->subMonths(3))->delete();
        $this->info("Deleted $deleted old activity logs.");
    }
}
