<?php

namespace App\Http\Controllers;
use App\Models\Room;
use App\Models\Hall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Key;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()&& Auth::user()->usertype == 'admin'){
        $room = Room::query()->orderBy('id', 'desc')->get();  //paginate(3)
        $hall = Hall::all();   
       return view('room.room' , ['room' => $room],compact('hall'));
        }
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
    public function getRooms($hallId, $gender)
    {
        $rooms = Room::where('hall_id', $hallId)
        ->where('gender', $gender)
        ->where('status', '!=', 'booked')
        ->where('status', '!=', 'approved')
        ->get();
        return response()->json(['rooms' => $rooms]);
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
        if (Auth::check()&& Auth::user()->usertype == 'admin'){
        $data = $request->validate([
            'type' => ['required', 'integer', 'min:0'],
            'gender' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'number' => ['required', 'integer'],
            'hall_id' => ['required', 'integer','exists:halls,id']
        ]); 
        $hall = Hall::find($data['hall_id']);
        $currentRoomCount = $hall->room->count();

        if ($currentRoomCount >= $hall->capacity){
            return redirect()->back()->withErrors(['hall_id' => 'Hall capacity exceeded']);
        }
         // Check room type limit within the specified hall
   
    if ($data['type'] == 4) {
        // Get the count of rooms in the same hall, block, and with the same room number
        $roomNumberCount = Room::where('hall_id', $data['hall_id'])
            //->where('gender', $data['gender']) // Assuming you have a block field
            ->where('number', $data['number']) // Assuming you have a room_number field
            ->count();
    
        if ($roomNumberCount >= 4) {
            return redirect()->back()->withErrors(['type' => 'Room Number type 4 in 1 this hall and block is full']);
        }
    }
    if ($data['type'] == 3) {
        // Get the count of rooms in the same hall, block, and with the same room number
        $roomNumberCount = Room::where('hall_id', $data['hall_id'])
            //->where('gender', $data['gender']) // Assuming you have a block field
            ->where('number', $data['number']) // Assuming you have a room_number field
            ->count();
    
        if ($roomNumberCount >= 3) {
            return redirect()->back()->withErrors(['type' => 'Room Number type 3 in 1 in this hall and block is full']);
        }
    }
    if ($data['type'] == 2) {
        // Get the count of rooms in the same hall, block, and with the same room number
        $roomNumberCount = Room::where('hall_id', $data['hall_id'])
            //->where('gender', $data['gender']) // Assuming you have a block field
            ->where('number', $data['number']) // Assuming you have a room_number field
            ->count();
    
        if ($roomNumberCount >= 2) {
            return redirect()->back()->withErrors(['type' => 'Room Number type 2 in 1 in this hall and block is full']);
        }
    }
    if ($data['type'] == 1) {
        // Get the count of rooms in the same hall, block, and with the same room number
        $roomNumberCount = Room::where('hall_id', $data['hall_id'])
            //->where('gender', $data['gender']) // Assuming you have a block field
            ->where('number', $data['number']) // Assuming you have a room_number field
            ->count();
    
        if ($roomNumberCount >= 1) {
            return redirect()->back()->withErrors(['type' => 'Room Number type 1 in 1 in this hall and block is full']);
        }
    }

        $room = Room::create($data);
         // Retrieve a key (use an appropriate method or criteria here)
         $key = Key::first(); // Fetch the first key, or use a specific criteria

        if ($key) {
            // Generate the key_number by combining key_id and room number
            $keyNumber = $key->key_code . '-' . $room->number;

            // Insert into the key_room table
            DB::table('key_room')->insert([
                'room_id' => $room->id,
                'key_id' => $key->id,
                'key_number' => $keyNumber,
                'status' => 'active', // or any other status you want to set
            ]);
        }
        return to_route('room.index', $room)->with('message', 'Room has been created');
    }
    return redirect('/')->with('error', 'You do not have access to this page.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        if (Auth::check()&& Auth::user()->usertype == 'admin'){
        $hall = Hall::all(); 
        return view('room.edit', ['room' => $room],compact('hall'));;
        }
        return redirect('/')->with('error', 'You do not have access to this page.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        if (Auth::check()&& Auth::user()->usertype == 'admin'){
        $data = $request->validate([
            'type' => ['required', 'integer', 'min:0'],
            'gender' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'number' => ['required', 'integer'],
            'hall_id' => ['required', 'integer','exists:halls,id']
        ]);

        $hall = Hall::find($data['hall_id']);
    $currentRoomCount = $hall->room->count();

    if ($currentRoomCount >= $hall->capacity) {
        return redirect()->back()->withErrors(['hall_id' => 'Hall capacity exceeded']);
    }
    if ($data['type'] == 4) {
        // Get the count of rooms in the same hall, block, and with the same room number
        $roomNumberCount = Room::where('hall_id', $data['hall_id'])
            //->where('gender', $data['gender']) // Assuming you have a block field
            ->where('number', $data['number']) // Assuming you have a room_number field
            ->count();
    
        if ($roomNumberCount >= 4) {
            return redirect()->back()->withErrors(['type' => 'Room Number type 4 in 1 this hall and block is full']);
        }
    }
    if ($data['type'] == 3) {
        // Get the count of rooms in the same hall, block, and with the same room number
        $roomNumberCount = Room::where('hall_id', $data['hall_id'])
            //->where('gender', $data['gender']) // Assuming you have a block field
            ->where('number', $data['number']) // Assuming you have a room_number field
            ->count();
    
        if ($roomNumberCount >= 3) {
            return redirect()->back()->withErrors(['type' => 'Room Number type 3 in 1 in this hall and block is full']);
        }
    }
    if ($data['type'] == 2) {
        // Get the count of rooms in the same hall, block, and with the same room number
        $roomNumberCount = Room::where('hall_id', $data['hall_id'])
            //->where('gender', $data['gender']) // Assuming you have a block field
            ->where('number', $data['number']) // Assuming you have a room_number field
            ->count();
    
        if ($roomNumberCount >= 2) {
            return redirect()->back()->withErrors(['type' => 'Room Number type 2 in 1 in this hall and block is full']);
        }
    }
    if ($data['type'] == 1) {
        // Get the count of rooms in the same hall, block, and with the same room number
        $roomNumberCount = Room::where('hall_id', $data['hall_id'])
            //->where('gender', $data['gender']) // Assuming you have a block field
            ->where('number', $data['number']) // Assuming you have a room_number field
            ->count();
    
        if ($roomNumberCount >= 1) {
            return redirect()->back()->withErrors(['type' => 'Room Number type 1 in 1 in this hall and block is full']);
        }
    }
    
        $room->update($data);
        $hall = Hall::all(); 
        return to_route('room.index', $room)->with('message','Room details has been update');
    }
    return redirect('/')->with('error', 'You do not have access to this page.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        if (Auth::check()&& Auth::user()->usertype == 'admin'){
        $room->delete();
        return to_route('room.index')->with('message','Room details has been deleted ');
        }
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}
