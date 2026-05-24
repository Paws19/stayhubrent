<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\UserInformation;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
     public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:accounts,email',
            'password' => 'required|string|min:8|confirmed',

            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        // Create account
        $account = Account::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Create user information
        UserInformation::create([
            'account_id' => $account->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()
            ->route('index')
            ->with('success', 'Account created successfully.');
    }
}
