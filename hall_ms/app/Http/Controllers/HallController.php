<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Key;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()&& Auth::user()->usertype == 'admin'){
        $halls = Hall::query()->orderBy('created_at', 'desc')->get();//->paginate();
       return view('Hall.index' , ['hall' => $halls]);
        }

        return redirect('/')->with('error','You do not have access to this page');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()&& Auth::user()->usertype == 'admin'){
        return view('Hall.create');
        }
        return redirect('/')->with('error', 'You do not have access to this page');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check()&& Auth::user()->usertype == 'admin'){
        $data = $request->validate([
            'name' => ['required', 'string'],
            'block' => ['required', 'string'],
            'location' => ['required', 'string'],
            'capacity' => ['required', 'integer', 'min:0'],
        ]);
         // Check if a hall with the same name, block, and location already exists
         $existingHall = Hall::where('name', $data['name'])
         ->where('block', $data['block'])
         ->where('location', $data['location'])
         ->where('capacity', $data['capacity'])
         ->first();

        if ($existingHall) {
        return redirect()->back()->with('error', 'A hall with the same name, block, and location already exists.');
        }

        $hall = Hall::create($data);
         // Create the key code by combining the first letter of the hall name and the last letter of the block
         $keyCode = substr($data['name'], 0, 1) . substr($data['block'], -1);

         // Insert the key into the keys table
         Key::create([
             'key_code' => $keyCode,
             //'room_id' => null // Assuming you'll associate it with a room later
         ]);
        return to_route('hall.index', $hall)->with('message', 'Hall was created');
    }
    return redirect('/')->with('error','You do not have access to this page');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hall $hall)
    {
        $rooms = $hall->room()->orderBy('number', 'asc')->get();
        $bookedRoomsCount = $rooms->where('status', 'booked')->count();
        $groupedRooms = $rooms->groupBy(function ($room) {
            return $room->number . '-' . $room->type; // Group by both number and type
        });
    
        return view('Hall.show', [
            'hall' => $hall,
            'groupedRooms' => $groupedRooms,
            'bookedRoomsCount' => $bookedRoomsCount,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hall $hall)
    {
        if (Auth::check()&& Auth::user()->usertype == 'admin'){
        return view('Hall.edit', ['hall' => $hall]);
        }
        return redirect('/')->with('error','You do not have access to this page');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hall $hall)
    {
        if (Auth::check()&& Auth::user()->usertype == 'admin'){
        $data = $request->validate([
            'name' => ['required', 'string'],
            'block' => ['required', 'string'],
            'location' => ['required', 'string'],
            'capacity' => ['required', 'integer'],
        ]);
        $hall->update($data);
        return to_route('hall.index', $hall)->with('message','Hall details has been update');
        }
        return redirect('/')->with('error','You do not have access to this page');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hall $hall)
    {
        if (Auth::check()&& Auth::user()->usertype == 'admin'){
        $hall->delete();
        return to_route('hall.index')->with('message','Hall details has been deleted ');
        }
        return redirect('/')->with('error','You do not have access to this page');
    }
}
