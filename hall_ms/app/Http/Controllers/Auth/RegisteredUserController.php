<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        if (Auth::check()&& Auth::user()->usertype == 'admin'){
        return view('auth.register');
        }
        return redirect('/')->with('error','You do not have access to this page');
    }
    
    
        
    public function index(){
        if (Auth::check()&& Auth::user()->usertype == 'admin'){
        $users = User::all();
        //$user = User::whereIn('usertype', ['student'])->get();
        return view('admin.userlist',compact('users'));
    }
        return redirect('/')->with('error','You do not have access to this page');
    
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'usertype' => ['required', 'string', 'in:admin,staff,student'], // Assuming you have these user types
            'index_number' => ['nullable','string', 'unique:'.User::class],
            'department' => ['nullable', 'string', 'max:255'],
            'level' => ['nullable', 'integer'],
            //'age' => ['nullable', 'integer', 'between:0,100'],
            //'gender' => ['nullable', 'string', 'in:male,female'],
            //'telephone' => ['nullable', 'string'],


        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => $request->usertype,
            'index_number' => $request->index_number,
            'department' => $request->department,
            'level' => $request->level,
            //'age' => $request->age,
            
            //'telephone' => $request->telephone,
        ]);

        event(new Registered($user));

        //Auth::login($user);

        return redirect(route('registerUser.index', absolute: false))->with('message', 'New user was created');
        //return to_route('admin.index', $user)->with('message', 'New user was created');
    }
    public function showRegisterForm()
    {
        if (Auth::check()&& Auth::user()->usertype == 'admin'){
        return view('admin.registerUser');
    }
        return redirect('/')->with('error','You do not have access to this page');
    
    }

    public function destroy($id)
    {
        
        if (Auth::check()&& Auth::user()->usertype == 'admin'){
            $user = User::findOrFail($id);
            $user->delete();
        return to_route('registerUser.index')->with('message','User details has been deleted ');
        }
        return redirect('/')->with('error','You do not have access to this page');
    }

    public function showUploadform(){
        return view('admin.upload');
    }
}
