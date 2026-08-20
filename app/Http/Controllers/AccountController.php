<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Mail\SendOTP as SendOTPMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'role' => 'required|in:landlord,tenant',
    ]);

    return redirect()->back()
        ->with('step', 2)
        ->with('selected_role', $request->role);
}

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        //For OTP verification, we can implement this method to show the OTP input form after the user selects their role and proceeds to the next step. However, since the OTP generation and sending logic is not implemented in the provided code snippets, we will leave this method empty for now. We can implement the OTP logic in a future iteration of the application.
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        //
    }

   public function login(Request $request)
{
    // Validate login form
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);


    // Find account
    $account = Account::where('email', $credentials['email'])->first();


    // Check if account exists
    if (!$account) {

        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Invalid email or password.'
            ]);
    }


    // Check password
    if (!Hash::check($credentials['password'], $account->password)) {

        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Invalid email or password.'
            ]);
    }


    // Check email verification
    if (is_null($account->email_verified_at)) {

        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Please verify your email before logging in.'
            ]);
    }


    // Log the account into Laravel authentication
    Auth::login($account);


    // Regenerate session for security
    $request->session()->regenerate();


    // Redirect based on role
    if ($account->role === 'landlord') {

        return redirect()->route('dashboard.landlord');

    } elseif ($account->role === 'tenant') {

        return redirect()->route('dashboard.tenant');
    }


    // Fallback
    return redirect()->route('dashboard');
}
}
