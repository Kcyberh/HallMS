<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $bookings = Booking::with(['hall','room','user'])
                ->where('user_id', $user->id)->get();
        return view('payment.paymentindex',compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check()&& Auth::user()->usertype == 'student'){
            $data = $request->validate([
                'amount' => ['required', 'string'],
                'image' => ['required', 'image'],
                'user_id' => ['required', 'integer'],
                'booking_id' => ['required', 'integer'],
                
            ]);
             // Check if payment already exists
        $existingPayment = Payment::where('user_id', $data['user_id'])
        ->where('booking_id', $data['booking_id'])
        ->first();
        if ($existingPayment) {
            return redirect()->back()->withErrors(['error' => 'Payment already exists for this booking.']);
        }
        
            $imagePath = $request->file('image')->store('uploads','public');

            $payment = Payment::create([
                'amount' => $data['amount'],
                'user_id' => $data['user_id'],
                'booking_id' => $data['booking_id'],
                'image' => $imagePath,
            ]);
            return to_route('payment.index', $payment)->with('message', 'Payment Succesful');
        }
        return redirect('/')->with('error','You do not have access to this page');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
       // return view('payment.show',['payment', $payment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
