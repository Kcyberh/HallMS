<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use phpDocumentor\Reflection\Types\Void_;
use App\Models\Booking;
use App\Models\Room;

class DeleteUnapprovedBooking implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $booking;
    /**
     * Create a new job instance.
     */
    
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       // Reload the booking from the database
       $booking = Booking::find($this->booking->id);

       // Check if the booking is still pending
       if ($booking && $booking->status == 'pending') {
           // Delete the booking
           $booking->delete();
           
            // Update the room status to available
            $room = Room::find($this->booking->room_id);
            if ($room) {
                $room->status = 'available';
                $room->save();
            }
        }

    }
}
