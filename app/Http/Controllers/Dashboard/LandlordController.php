<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LandlordDetail;
use App\Models\UserInformation;
use Illuminate\Http\Request;

class LandlordController extends Controller
{
    public function index()
{
    $accountId = UserInformation::where('account_id', auth()->id())->value('account_id');

    $landlordProperty = LandlordDetail::where('account_id', $accountId)->first();

    return view('dashboard.landlord', compact('landlordProperty'));
}
}
