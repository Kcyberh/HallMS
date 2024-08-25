<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Hall;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        switch ($user->usertype) {
            case 'admin':
                $roomCount = Room::count();
                $available = Room::where('status','available')->count();
                $booked = Room::where('status','booked')->count();
                $hallCount = Hall::count();
                $capacity = Hall::sum('capacity');
                $bookingCount = Booking::count();
                $approved = Booking::where('status','approved')->count();
                $pending = Booking::where('status','pending')->count();
                $payment = Payment::count();
                $user = User::count();
                $student = User::where('usertype','student')->count();
                $admin = User::where('usertype','admin')->count();
                $staff = User::where('usertype','staff')->count();
                return view('admin.index', compact('roomCount','capacity',
                'hallCount','bookingCount','approved','pending','payment',
                'student','admin','staff','user',
                'available','booked'));
            case 'staff':
                $roomCount = Room::count();
                $available = Room::where('status','available')->count();
                $booked = Room::where('status','booked')->count();
                $hallCount = Hall::count();
                $capacity = Hall::sum('capacity');
                $bookingCount = Booking::count();
                $approved = Booking::where('status','approved')->count();
                $pending = Booking::where('status','pending')->count();
                $payment = Payment::count();
                $user = User::count();
                $student = User::where('usertype','student')->count();
                $admin = User::where('usertype','admin')->count();
                $staff = User::where('usertype','staff')->count();
                return view('staff.index', compact('roomCount','capacity',
                'hallCount','bookingCount','approved','pending','payment',
                'student','admin','staff','user',
                'available','booked'));
                // return view();
            case 'student':
                // Fetch the user's own bookings
                $bookings = Booking::with(['hall', 'room', 'user'])
                ->where('user_id', $user->id)
                ->get();

                // Fetch all bookings that have the same room number and hall ID
                $room = $bookings->first()->room;
                $roomNumber = $room->number;
                $hallId = $room->hall_id;

                $relatedBookings = Booking::whereHas('room', function($query) use ($roomNumber, $hallId) {
                $query->where('hall_id', $hallId)
                ->where('number', $roomNumber);
                })->get();

                // Fetch the keys associated with the rooms in the related bookings
                $keys = DB::table('key_room')
                ->join('keys', 'key_room.key_id', '=', 'keys.id')
                ->select('key_room.room_id', 'keys.key_code', 'key_room.key_number')
                ->whereIn('key_room.room_id', $relatedBookings->pluck('room_id'))
                ->get()
                ->groupBy('room_id');

                // Pass both sets of bookings and keys to the view
                return view('students.index', [
                'bookings' => $bookings,
                'relatedBookings' => $relatedBookings,
                'keys' => $keys,
                ]);
                
            default:
                return view('weclome');
        }
    }
    
    
}
