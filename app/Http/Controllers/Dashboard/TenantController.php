<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceRequestModel;
use App\Models\UserInformation;
use App\Models\Tenant\PaymentHistoryModel;
use App\Models\Tenant\AssignApartmentModel;
use Illuminate\Http\Request;

class TenantController extends Controller
{
 public function index()
{
    $accountId = UserInformation::where('account_id', auth()->id())->value('account_id');

    //get first name
    $GetFirstName = UserInformation::where('account_id', $accountId)->first();

    //Retrieve the payment history for the logged-in tenant
    $paymentHistory = PaymentHistoryModel::where('account_id', $accountId)
        ->latest()
        ->get();

    $pendingRequests = MaintenanceRequestModel::where('account_id', $accountId)
        ->where('request_status', 'pending')
        ->latest()
        ->get();

    $resolvedRequests = MaintenanceRequestModel::where('account_id', $accountId)
        ->where('request_status', 'completed')
        ->latest()
        ->get();

    $hasRoom = AssignApartmentModel::where('account_id', $accountId)->exists();

    
    

    return view('dashboard.tenant', compact('pendingRequests', 'resolvedRequests', 'GetFirstName', 'paymentHistory', 'hasRoom'));
}
}
