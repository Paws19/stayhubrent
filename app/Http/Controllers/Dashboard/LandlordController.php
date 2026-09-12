<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\LandlordDetail;
use App\Models\UserInformation;
use Illuminate\Http\Request;

class LandlordController extends Controller
{
    public function index()
{
    $accountId = Account::where('id', session('account_id'))->value('id');

    $landlordProperty = LandlordDetail::where('account_id', $accountId)->first();

    return view('dashboard.landlord', compact('landlordProperty'));
}



    //add new apartment
  
public function AddNewApartment(Request $request)
{
    // 1. Validate
    $validated = $request->validate([
        'apartment_name'         => 'required|string|max:255',
        'room_name'              => 'required|string|max:255',
        'room_type'              => 'required|string|max:255',
        'apartment_address'      => 'required|string|max:1000',
        'apartment_image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'monthly_rent'           => 'required|numeric|min:0',
        'total_beds_in_room'     => 'required|integer|min:1',
        'available_beds_in_room' => 'required|integer|min:0|lte:total_beds_in_room',
        'amenities'              => 'nullable|string|max:1000',
        'latitude'               => 'nullable|numeric|between:-90,90',
        'longitude'              => 'nullable|numeric|between:-180,180',
    ]);

    // 2. Get logged-in landlord
    $accountId = session('account_id');

    // Temporary debug — remove later
    if (!$accountId) {
        return redirect()->back()
            ->with('error', 'No account_id found in session. Please log in again.');
    }

    try {
        // 3. Handle image upload
        $imagePath = null;
        if ($request->hasFile('apartment_image')) {
            $imagePath = $request->file('apartment_image')->store('apartments', 'public');
        }

        // 4. Create the apartment
        $apartment = \App\Models\Landlord\NewApartmentModel::create([
            'account_id'             => $accountId,
            'apartment_name'         => $validated['apartment_name'],
            'room_name'              => $validated['room_name'],
            'room_type'              => $validated['room_type'],
            'apartment_address'      => $validated['apartment_address'],
            'apartment_image'        => $imagePath,
            'monthly_rent'           => $validated['monthly_rent'],
            'total_beds_in_room'     => $validated['total_beds_in_room'],
            'available_beds_in_room' => $validated['available_beds_in_room'],
            'amenities'              => $validated['amenities'] ?? null,
            'latitude'               => $validated['latitude'] ?? null,
            'longitude'              => $validated['longitude'] ?? null,
        ]);

        // Temporary success debug
        return redirect()->back()
            ->with('success', 'Apartment saved successfully! ID: ' . $apartment->id);

    } catch (\Exception $e) {
        // This will show the REAL error on the page
        return redirect()->back()
            ->withInput()
            ->with('error', 'ERROR: ' . $e->getMessage());
    }
}

}
