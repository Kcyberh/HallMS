<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $hall = Hall::create($data);
        return to_route('hall.index', $hall)->with('message', 'Hall was created');
    }
    return redirect('/')->with('error','You do not have access to this page');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hall $hall)
    {
        $rooms = $hall->room()->get();
        $bookedRoomsCount = $rooms->count();
        return view('Hall.show', ['hall' => $hall,
        'room' => $rooms,
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
