<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceRequestModel;
use Illuminate\Http\Request;

class TenantController extends Controller
{
 public function index()
{
    $accountId = auth()->id();

    $pendingRequests = MaintenanceRequestModel::where('account_id', $accountId)
        ->where('request_status', 'pending')
        ->latest()
        ->get();

    return view('dashboard.tenant', compact('pendingRequests'));
}
}
