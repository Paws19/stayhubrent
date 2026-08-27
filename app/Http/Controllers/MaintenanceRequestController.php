<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRequestModel;

use Illuminate\Http\Request;

class MaintenanceRequestController extends Controller
{
    public function store(Request $request)
{
    // Get the currently authenticated account
    $accountId = auth()->id();

    // Make sure the user is logged in
    if (!$accountId) {
        return redirect()
            ->back()
            ->with('error', 'You must be logged in to submit a maintenance request.');
    }

    // Validate request
    $validated = $request->validate([
        'request_title' => [
            'required',
            'string',
            'in:plumbing,electrical,aircon,furniture,other',
        ],

        'request_description' => [
            'required',
            'string',
            'max:1000',
        ],

        'request_image' => [
            'nullable',
            'image',
            'mimes:jpeg,png,jpg,gif,svg',
            'max:2048',
        ],
    ]);


    // Upload image if provided
    $imagePath = null;

    if ($request->hasFile('request_image')) {

        $imagePath = $request->file('request_image')
            ->store('maintenance_requests', 'public');
    }


    // Create maintenance request
    MaintenanceRequestModel::create([
        'account_id' => $accountId,
        'request_title' => $validated['request_title'],
        'request_description' => $validated['request_description'],
        'request_image' => $imagePath,
        'request_status' => 'pending',
    ]);


    // Return success
    return redirect()
        ->back()
        ->with('success', 'Maintenance request submitted successfully.');
}
}
