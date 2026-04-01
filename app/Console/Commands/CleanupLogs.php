<?php

namespace App\Console\Commands;

use App\Models\MailLog;
use App\Models\SmsLog;
use App\Models\SystemSetting;
use Illuminate\Console\Command;

class CleanupLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cleanup-logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup old mail and sms logs based on system settings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $settings = SystemSetting::get('maintenance_settings');
        $days = $settings['log_retention_days'] ?? 30;

        $this->info("Cleaning up logs older than {$days} days...");

        $threshold = now()->subDays($days);

        $mailDeleted = MailLog::where('created_at', '<', $threshold)->delete();
        $smsDeleted = SmsLog::where('created_at', '<', $threshold)->delete();

        $this->info("Deleted {$mailDeleted} mail logs.");
        $this->info("Deleted {$smsDeleted} sms logs.");
    }
}
