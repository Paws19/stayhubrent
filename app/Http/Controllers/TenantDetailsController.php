<?php

namespace App\Http\Controllers;

use App\Models\TenantDetail;
use Illuminate\Http\Request;

class TenantDetailsController extends Controller
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
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|max:10',
            'occupation_or_school' => 'required|string|max:255',
            'preferred_location' => 'required|string|max:255',
            'min_budget' => 'required|numeric|min:0',
            'max_budget' => 'required|numeric|min:0',
            'room_type' => 'required|string|max:255',
            'amenities' => 'nullable|array',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_number' => 'required|string|max:20',
        ]);

        $tenantDetail = TenantDetail::create([
            'account_id' => $request->account_id,
            'birthday' => $request->date_of_birth,
            'gender' => $request->gender,
            'occupation_or_school' => $request->occupation_or_school,
            'preferred_location' => $request->preferred_location,
            'min_budget' => $request->min_budget,
            'max_budget' => $request->max_budget,
            'room_type_preference' => $request->room_type,
            'tenant_wants_amenities' => $request->amenities,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_number' => $request->emergency_contact_number,
        ]);

         return redirect()->back()
        ->with('success', 'Tenant details saved successfully.')
        ->with('step', 4)
        ->with('selected_role', $request->role)
        ->with('account_id', $request->account_id);

    }

    /**
     * Display the specified resource.
     */
    public function show(TenantDetail $tenantDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TenantDetail $tenantDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TenantDetail $tenantDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TenantDetail $tenantDetail)
    {
        //
    }
    
}
