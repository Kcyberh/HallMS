<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Resident;
use App\Models\User;
use App\Models\Hall;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()&& Auth::user()->usertype == 'staff'){
        $resident = Resident::with(['user','booking.hall','booking.room'])
        ->get();
        return view('resident.index',compact('resident'));
        } 
        elseif(Auth::check()&& Auth::user()->usertype == 'admin'){
            $resident = Resident::with(['user','booking.hall','booking.room'])
            ->get();
            return view('admin.residents',compact('resident'));
            
        }
        return redirect('/')->with('error','You do not have access to this page');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resident.registerResident');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check()&& Auth::user()->usertype == 'staff'){
            $data = $request->validate([
                'guardian_name' => ['required', 'string'],
                'guardian_phone' => ['required', 'string'],
                'guardian_address' => ['required', 'string'],
                'occupation' => ['required', 'string'],
                'image' => ['required', 'image','mimes:jpeg,png,jpg,gif', 'max:2048'],
                'user_id' => ['required', 'integer'],
                'booking_id' => ['required', 'integer'],
                'payment_id' => ['required', 'integer'],
                
            ]);
             // Check if resident already exists
        $existingResident = Resident::where('user_id', $data['user_id'])
        ->where('booking_id', $data['booking_id'])
        ->first();
        if ($existingResident) {
            return redirect()->back()->withErrors(['error' => 'Resident already exists.']);
        }
        
            $imagePath = $request->file('image')->store('uploads','public');

            $resident = Resident::create([
                'guardian_name' => $data['guardian_name'],
                'guardian_phone' => $data['guardian_phone'],
                'guardian_address' => $data['guardian_address'],
                'occupation' => $data['occupation'],
                'user_id' => $data['user_id'],
                'booking_id' => $data['booking_id'],
                'payment_id' => $data['payment_id'],
                'image' => $imagePath,
            ]);
            return to_route('resident.create', $resident)->with('message', 'Registration Succesful');
        }
        return redirect('/')->with('error','You do not have access to this page');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Resident $resident)
    {
        if (Auth::check()&& Auth::user()->usertype == 'staff'){
       // $booking = $resident->bookings()->get();
        return view('resident.show', ['resident' => $resident]);
    }
        elseif(Auth::check()&& Auth::user()->usertype == 'admin')
        {
            return view('admin.showresident', ['resident' => $resident]);
            
        }
        return redirect('/')->with('error','You do not have access to this page');
   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resident $resident)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resident $resident)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resident $resident)
    {
        //
        $resident->delete();

        // Redirect back with a success message
        return redirect()->back()->with('errors', 'Resident record deleted successfully.');
    }
    Public function search(Request $request){
        $request->validate([
            'index_number' => 'required|integer|min:0',
        ]);

        if (Auth::check() && Auth::user()->usertype == 'staff') {
            $user = User::where('index_number', $request->index_number)->first();

            if ($user) {
                // $payment = Payment::with(['user','booking.hall','booking.room','booking'])
                // ->where('status','approved')
                // ->get();
                $payment = Payment::with(['user', 'booking.hall', 'booking.room', 'booking'])
                ->where('status', 'approved')
                ->whereHas('user', function($query) use ($user) {
                    $query->where('id', $user->id); // or where('index_number', $user->index_number) if using index number
                })
                ->get();
                return view('resident.registerResident', compact('user','payment'));
                
            } else {
                return redirect()->route('resident.create')->with('error', 'Student not found');
            }
        }
        return redirect('/')->with('error', 'You do not have access to this page');
    }

}
