<?php

namespace App\Http\Controllers;

use App\Models\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Keylog;
use App\Models\Room;
use App\Models\Hall;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class KeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keys = DB::table('key_room')
        ->join('keys', 'key_room.key_id', '=', 'keys.id')
        ->join('rooms', 'key_room.room_id', '=', 'rooms.id') // Join with the rooms table
        ->select('key_room.id', 'rooms.number', 'keys.key_code', 'key_room.key_number', 'key_room.status')
        ->get();

    return view('keys.key', compact('keys'));

    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user(); // Retrieve the authenticated user

        $hall = Hall::all();
        $rooms = Room::all();

        $keyLogs = KeyLog::with('user', 'room')->get();
       
    
        return view('keys.keylog', compact('user','hall','rooms','keyLogs'));
    }
  

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
      // Validate the incoming request data
    $request->validate([
        'student_name' => 'required|string|max:255',
        'room_id' => 'required|exists:rooms,id',
        'action' => 'required|in:active,returned,lost',
        'details' => 'nullable|string',
    ]);

    // Find the user by the student's name
    $user = User::where('name', $request->input('student_name'))->first();

    if (!$user) {
        return redirect()->back()->withErrors(['student_name' => 'Student not found'])->withInput();
    }

    // Insert the data into the key logs table
    $keyLog = new KeyLog([
        'key_room_id' => $request->input('room_id'),
        'user_id' => $user->id,
        'action' => $request->input('action'),
        'details' => $request->input('details'),
    ]);

    $keyLog->save();

    // Redirect with a success message
    return redirect()->route('key.create')->with('success', 'Key log action has been successfully recorded.');
}
    

    /**
     * Display the specified resource.
     */
    public function show(Key $key)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Key $key)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{ // Fetch the record from the key_room table with the necessary joins
    $keyRoom = DB::table('key_room')
        ->join('keys', 'key_room.key_id', '=', 'keys.id')
        ->where('key_room.id', $id)
        ->select('key_room.*')
        ->first();

    // Check if the record exists
    if (!$keyRoom) {
        return redirect()->route('keys.index')->with('error', 'Key not found.');
    }

    // Update the status in the key_room table
    DB::table('key_room')
        ->where('id', $id)
        ->update(['status' => $request->input('status')]);

    return redirect()->route('key.index')->with('success', 'Key status updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Key $key)
    {
        //
    }
    public function logAction(Request $request)
{
    $validated = $request->validate([
        'key_room_id' => 'required|exists:key_room,id',
        'user_id' => 'required|exists:users,id',
        'action' => 'required|string',
        'details' => 'nullable|string',
    ]);

    KeyLog::create($validated);

    // Optionally update the key's status
    DB::table('key_room')->where('id', $request->key_room_id)->update(['status' => $request->action]);

    return redirect()->route('keys.index')->with('success', 'Key action logged successfully.');
}
}
