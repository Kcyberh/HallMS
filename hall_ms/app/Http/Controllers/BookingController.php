<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Hall;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Jobs\DeleteUnapprovedBooking;
use App\Models\Payment;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()&& Auth::user()->usertype == 'student'){
            $hall = Hall::all();

        return view('booking.index',compact('hall'));


        }
        return redirect('/')->with('error', 'You do have access to this page');
    }

    /**
     * Show the form for creating a new resource.
     */
    Public function search(Request $request){
        $request->validate([
            'index_number' => 'required|integer|min:0',
        ]);

        if (Auth::check() && Auth::user()->usertype == 'student') {
            $user = User::where('index_number', $request->index_number)->first();

            if ($user) {
                $hall = Hall::all();
                return view('booking.index', compact('user','hall'));
            } else {
                return redirect()->route('booking.index')->with('error', 'Student not found');
            }
        }
        return redirect('/')->with('error', 'You do not have access to this page');
    }



    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        if (Auth::check()&& Auth::user()->usertype == 'student'){
        $validatedData = $request->validate([
            'started_at' => 'required|date',
            'ending_at' => 'required|date',
            'user_id' => 'required|integer',
            'room_id' => 'required|integer',
            'hall_id' => 'required|integer',
            'gender' => 'required|string',
            'telephone' => 'required|string',
            'age' => 'required|integer',
        ]);
         // Check if the user already has a booking
         $existingBooking = Booking::where('user_id', $validatedData['user_id'])->first();
         if ($existingBooking) {
             return redirect()->route('booking.index')->with('errorss', 'You have already booked a room.');
         }

        DB::beginTransaction();

        try {
            // Create the booking
            $booking = Booking::create(['started_at' => $validatedData['started_at'],
                'ending_at' => $validatedData['ending_at'],
                'user_id' => $validatedData['user_id'],
                'room_id' => $validatedData['room_id'],
                'hall_id' => $validatedData['hall_id'],
                'gender' => $validatedData['gender'],
                'telephone' => $validatedData['telephone'],
                'age' => $validatedData['age']
            ]);
// Dispatch the job to delete the booking if not approved within 30 seconds
            DeleteUnapprovedBooking::dispatch($booking)->delay(now()->addSeconds(30));

            // Update the room status
            $room = Room::find($validatedData['room_id']);
            if ($room) {
                $room->status = 'booked';
                $room->save();
            } else {
                throw new \Exception('Room not found');
            }

            DB::commit();

            // Return a response
            return redirect()->route('booking.index')->with('success', 'Booking request successfully sent.');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    return redirect()->route('booking.index')->with('error', 'Unauthorized');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        // Retrieve the room associated with the booking
    $room = $booking->room;

    // Retrieve the key associated with the room from the key_room table
    $key = DB::table('keys')
        ->join('key_room', 'keys.id', '=', 'key_room.key_id')
        ->where('key_room.room_id', $room->id)
        ->select('keys.*')
        ->first();

    return view('room.show', [
        'booking' => $booking,
        'key' => $key
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        // return view('booking.pending', ['payment' => $payment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function manageBooking(){
       
        if (Auth::check()&& Auth::user()->usertype == 'admin'){
            $bookings = Booking::with(['hall','room','user'])
            ->get();

            return view('booking.managebooking',compact('bookings'));


        }
        return redirect('/')->with('error', 'You do have access to this page');
   
        
    }

    public function pendingBooking(){
       // $user = Auth::user();
        if(auth::check() && Auth::user()->usertype == 'admin'){
            $payment = Payment::with(['user','booking.hall','booking.room','booking'])
            ->where('status','pending')
            ->get();
           
           
        return view('booking.pending',compact('payment'));
    }
    return redirect('/')->with('error', 'You do have access to this page');
    } 

    public function approve(Request $request, Payment $payment)
{
    // Update the payment status
    $payment->update(['status' => 'approved']);

    // Update the associated booking status
    $payment->booking->update(['status' => 'approved']);

    // Redirect back with a success message
    return back()->with('success', 'Booking and Payment approved successfully.');
}

   public function approvedBooking(){
         // $user = Auth::user();
          if(auth::check() && Auth::user()->usertype == 'admin'){
                $payment = Payment::with(['user','booking.hall','booking.room','booking'])
                ->where('status','approved')
                ->get();
             
              
          return view('booking.approved',compact('payment'));
     }
     return redirect('/')->with('error', 'You do have access to this page');

   }
    
}
