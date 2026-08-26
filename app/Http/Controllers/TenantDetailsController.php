<?php

namespace App\Http\Controllers;

use App\Models\TenantDetails;
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
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenant_details,email',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $tenantDetails = new TenantDetails();
        $tenantDetails->full_name = $request->input('full_name');
        $tenantDetails->email = $request->input('email');
        $tenantDetails->phone_number = $request->input('phone_number');
        $tenantDetails->address = $request->input('address');
        $tenantDetails->save();

        return redirect()->route('dashboard.tenant')->with('success', 'Tenant details saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TenantDetails $tenantDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TenantDetails $tenantDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TenantDetails $tenantDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TenantDetails $tenantDetails)
    {
        //
    }
}
