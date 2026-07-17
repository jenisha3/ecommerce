<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('customer.profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',

        'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($user->id),
        ],

        'phone' => 'nullable|string|max:20',

        'address' => 'nullable|string|max:500',

        'current_password' => 'nullable',

        'password' => 'nullable|min:8|confirmed',
    ]);

    // Update basic information
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->address = $request->address;

    // Change password only if user entered a new password
    if ($request->filled('password')) {

        if (!$request->filled('current_password')) {

            return back()
                ->withErrors([
                    'current_password' => 'Current password is required.'
                ])
                ->withInput();
        }

        if (!Hash::check($request->current_password, $user->password)) {

            return back()
                ->withErrors([
                    'current_password' => 'Current password is incorrect.'
                ])
                ->withInput();
        }

        // User model automatically hashes the password
        $user->password = $request->password;
    }

    $user->save();

    return back()->with('success', 'Profile updated successfully.');
}
}