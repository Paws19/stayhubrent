<?php

namespace App\Http\Controllers;

use App\Models\LandlordDetail;
use Illuminate\Http\Request;

class LandlordDetailController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{  
    $request->validate([
        'account_id' => 'required|integer|exists:accounts,id',

        'property_name' => 'required|string|max:255',
        'property_type' => 'required|string|max:255',

        'number_of_rooms' => 'required|integer|min:1',
        'number_of_floors' => 'nullable|integer|min:1',
        'bed_per_room' => 'required|integer|min:1',
        'monthly_rent' => 'required|numeric|min:0',

        'full_address' => 'required|string|max:255',

        'amenities' => 'nullable|array',
        'house_rules' => 'nullable|string|max:1000',
    ]);

    $landlordDetail = LandlordDetail::create([
        'account_id' => $request->account_id,
        'property_name' => $request->property_name,
        'property_type' => $request->property_type,
        'number_of_rooms' => $request->number_of_rooms,
        'number_of_floors' => $request->number_of_floors,
        'bed_per_room' => $request->bed_per_room,
        'monthly_rent' => $request->monthly_rent,
        'full_address' => $request->full_address,

        // JSON column
        'amenities' => $request->amenities,

        'house_rules' => $request->house_rules,
    ]);


   return redirect()->back()
    ->withInput()
    ->with('success', 'Landlord details saved successfully.')
    ->with('step', 4)
    ->with('account_id', $request->account_id);
}

    /**
     * Display the specified resource.
     */
    public function show(LandlordDetail $landlordDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LandlordDetail $landlordDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LandlordDetail $landlordDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LandlordDetail $landlordDetail)
    {
        //
    }
}
