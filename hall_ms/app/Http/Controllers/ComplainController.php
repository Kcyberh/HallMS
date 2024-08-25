<?php

namespace App\Http\Controllers;

use App\Models\Complains;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\Resident;
use App\Models\User;

class ComplainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()&& Auth::user()->usertype == 'student'){
            // Fetch the authenticated user
        $user = Auth::user();
        
        // Fetch the user's booking details
        $booking = Booking::where('user_id', $user->id)->first();

        // Retrieve the resident ID from the residents table
        $resident = Resident::where('user_id', $user->id)->first();

        // If no resident is found, handle this case
        if (!$resident) {
            return redirect('/')->with('error', 'No resident information found for this user.');
        }

        // Fetch all complaints
       // Fetch all complaints for the authenticated user
       $complaints = Complains::where('user_id', $user->id)->get();

        // Pass the necessary data to the view
        return view('complains.index', [
            'user' => $user,
            'booking' => $booking,
            'resident_id' => $resident->id, 
            'complaints' => $complaints,
        ]);
        }


    //     return view('complains.index');
    // }
    return redirect('/')->with('error', 'You do have access to this page');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $complaints = Complains::with('user')->get();
        return view('complains.manage', compact('complaints'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check()&& Auth::user()->usertype == 'student'){
            
                // Validate the input
    $validatedData = $request->validate([
        'time_date' => 'required|date|before_or_equal:today', // Validate that the date is not in the future
        'statement' => 'required|string|max:1000', // Validate the statement to be a string with a max length
        'user_id' => 'required|exists:users,id', // Ensure the user_id exists in the users table
        'resident_id' => 'required|exists:residents,id', // Ensure the resident_id exists in the residents table
    ]);
    

    // Insert the validated data into the database
    Complains::create([
        'time_date' => $validatedData['time_date'],
        'statement' => $validatedData['statement'],
        'user_id' => $validatedData['user_id'],
        'resident_id' => $validatedData['resident_id'],
    ]);

    // Redirect or return a response
    return redirect()->route('complain.index')->with('success', 'Complain submitted successfully.');

            return redirect('/')->with('error', 'You do have access to this page');

    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Complains $complain)
    {
        return view('complains.show', [
            'complain' => $complain,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complains $complains)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $complain = Complains::findOrFail($id);
    $complain->reply = $request->input('reply');
    $complain->status = 'resolved'; // Or update status based on your logic
    $complain->save();

    return redirect()->route('complain.create')->with('success', 'Complaint updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $complain = Complains::findOrFail($id);
        $complain->delete();
    
        return redirect()->route('complain.create')->with('success', 'Complaint deleted successfully.');
    }
}
