<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterUserController extends Controller
{
    public function create()
    {
        return view('auth.register'); // mag-load gihapon sa imong auth/register.blade.php
    }

    public function store(Request $request)
    {
        $request->validate([
            'first-name' => ['required', 'string', 'max:255'],
            'last-name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'institution' => ['required', 'string', 'max:255'],
            'terms' => ['accepted'],
            'name' => ['nullable'], // ADD THIS
        ]);

        $user = User::create([
            'name' => $request->input('first-name') . ' ' . $request->input('last-name'), // Concatenated full name
            'first_name' => $request->input('first-name'),
            'last_name' => $request->input('last-name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'institution' => $request->input('institution'),
        ]);

        Auth::login($user);

        return redirect()->route('repository.dashboard')->with('success', 'Welcome to UMIR, '.$user->first_name.'!');
    }


}
