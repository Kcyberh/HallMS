<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;

class DeleteUnapprovedBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-unapproved-bookings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete unapproved bookings older than 30 seconds and make rooms available';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $threshold = Carbon::now()->subSeconds(30);

        // Find and delete old unapproved bookings
        $bookings = Booking::where('status', 'pending')
            ->where('created_at', '<', $threshold)
            ->get();

        foreach ($bookings as $booking) {
            // Make the room available again
            $room = Room::find($booking->room_id);
            if ($room) {
                $room->status = 'available';
                $room->save();
            }

            // Delete the booking
            $booking->delete();
        }

        $this->info('Deleted unapproved bookings older than 30 seconds and made rooms available.');
    
    }
}
