<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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

    //payment Stack
    public function callback(Request $request)
{
    // Retrieve payment details from Paystack
    $paymentDetails = Payment::getPaymentData();

    // Process payment details (e.g., update database, check payment status)

    // After processing, redirect the user to your payment page
    return redirect()->to('http://127.0.0.1:8000/payment')
        ->with('success', 'Payment completed successfully.');
}
    //payment with paystack
    public function initialize(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric',
        ]);
        
        $existingPayment = Payment::where('user_id', $data['user_id'])
        ->where('booking_id', $data['booking_id'])
        ->first();
        if ($existingPayment) {
            return redirect()->back()->withErrors(['error' => 'Payment already exists for this booking.']);
        }
        // Store the payment in the database
        $payment = Payment::create([
            'amount' => $data['amount'],
            'user_id' => $data['user_id'],
            'booking_id' => $data['booking_id'],
        ]);

        // Initialize payment with Paystack
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
            'Cache-Control' => 'no-cache',
        ])->post('https://api.paystack.co/transaction/initialize', [
            'email' => $payment->user->email, // Assuming the user has an email field
            'amount' => $data['amount'] * 100, // Convert to kobo
        ]);

        $result = $response->json();

        if ($result['status']) {
            // Redirect to the payment page
            return redirect($result['data']['authorization_url']);
        } else {
            // Handle error
            return back()->with('error', 'Payment initialization failed.');
        }
    }
}
