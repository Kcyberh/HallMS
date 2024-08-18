<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ScheduleDeleteUnapprovedBookings extends Command
{
    protected $signature = 'schedule:delete-unapproved-bookings';
    protected $description = 'Schedule the deletion of unapproved bookings';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // This will schedule the command to run every minute
        Artisan::call('schedule:run');
        $this->info('Scheduler has been triggered.');
    }
}