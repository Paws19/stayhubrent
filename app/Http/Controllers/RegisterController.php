<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\UserInformation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail ;
use App\Mail\SendOTP;

class RegisterController extends Controller
{
     


public function store(Request $request)
{
    $request->validate([
        'email' => 'required|string|email|max:255|unique:accounts,email',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:landlord,tenant',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
    ]);

    // ========================================
    // 1. CREATE ACCOUNT
    // ========================================

    $account = Account::create([
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);


    // ========================================
    // 2. CREATE USER INFORMATION
    // ========================================

    UserInformation::create([
        'account_id' => $account->id,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'phone_number' => $request->phone_number,
    ]);


    // ========================================
    // 3. GENERATE OTP
    // ========================================

    $otp = rand(100000, 999999);


    // ========================================
    // 4. SAVE OTP IN DATABASE
    // ========================================

    Account::where('id', $account->id)->update([
        'verification_token' => $otp,
    ]);


    // ========================================
    // 5. ALSO SAVE OTP IN SESSION
    // ========================================

    session([
        'otp' => $otp,
        'otp_email' => $request->email,
        'otp_account_id' => $account->id,
    ]);


    // ========================================
    // 6. SEND OTP EMAIL
    // ========================================

    Mail::to($request->email)->send(
        new SendOTP($otp)
    );


    // ========================================
    // 7. GO TO OTP VERIFICATION STEP
    // ========================================

    return redirect()->back()
        ->withInput()
        ->with(
            'success',
            'Account created successfully. We sent a verification code to your email.'
        )
        ->with('step', 3)
        ->with('selected_role', $request->role)
        ->with('account_id', $account->id);
}

public function verifyOTP(Request $request)
{
    // ========================================
    // 1. VALIDATE OTP
    // ========================================

    $request->validate([
        'otp' => 'required|digits:6',
    ]);


    // ========================================
    // 2. GET ACCOUNT ID FROM SESSION
    // ========================================

    $accountId = session('otp_account_id');


    // ========================================
    // 3. CHECK ACCOUNT ID
    // ========================================

    if (!$accountId) {

        return redirect()->back()
            ->with('error', 'Your verification session has expired. Please register again.')
            ->with('step', 4);
    }


    // ========================================
    // 4. FIND ACCOUNT + CHECK OTP
    // ========================================

    $account = Account::where('id', $accountId)
        ->where('verification_token', $request->otp)
        ->first();


    // ========================================
    // 5. CHECK IF OTP IS WRONG
    // ========================================

    if (!$account) {

        return redirect()->back()
            ->withInput()
            ->with('error', 'Invalid OTP. Please check your email and try again.')
            ->with('step', 4);
    }


    // ========================================
    // 6. MARK EMAIL AS VERIFIED
    // ========================================

    $account->email_verified_at = now();


    // ========================================
    // 7. REMOVE OTP FROM ACCOUNT
    // ========================================

    $account->verification_token = null;


    // ========================================
    // 8. SAVE ACCOUNT
    // ========================================

    $account->save();


    // ========================================
    // 9. CLEAR OTP SESSION
    // ========================================

    session()->forget([
        'otp',
        'otp_email',
        'otp_account_id',
    ]);


    // ========================================
    // 10. SUCCESS
    // ========================================

    return redirect()->route('login')
        ->with(
            'success',
            '🎉 Account created successfully! Your email has been verified.'
        );
}
}
