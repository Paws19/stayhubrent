<?php

namespace App\Http\Controllers;

use App\Models\UserInformation;
use Illuminate\Http\Request;

class UserInformationController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'account_id' => 'required|integer|exists:accounts,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
           
        ]);

        $userInformation = UserInformation::create([
            'account_id' => $request->account_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
           
        ]);
if ($userInformation) {
   return redirect()->back()
    ->with('success', 'Account created successfully.')
    ->with('step', 3);
}

return redirect()
    ->back()
    ->with('error', 'Failed to create user information. Please try again.');
            

    }

    /**
     * Display the specified resource.
     */
    public function show(UserInformation $userInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserInformation $userInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserInformation $userInformation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserInformation $userInformation)
    {
        //
    }
}
