<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\DeleteUnapprovedBookings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

/*Schedule::call(function () {
    DB::table('bookings')
    ->where('status', 'pending')
    ->delete();
})->everyFiveSeconds(); 
*/
/*Artisan::call('schedule:run');
        $this->info('Scheduler has been triggered.'); */