<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Hall;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
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
                $bookings = Booking::with(['hall','room','user'])
                ->where('user_id', $user->id)->get();
                
                return view('students.index', compact('bookings'));
            default:
                return view('weclome');
        }
    }
    
}
