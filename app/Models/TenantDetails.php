<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantDetails extends Model
{
    protected $table = 'tenant_details';

    protected $fillable = [
        'account_id',
        'birthday',
        'gender',
        'occupation_or_school',
        'preferred_location',
        'min_budget',
        'max_budget',
        'room_type_preference',
        'tenant_wants_amenities',
        'emergency_contact_name',
        'emergency_contact_number',
    ];

    protected $casts = [
    'tenant_wants_amenities' => 'array',
    'preferred_location' => 'encrypted',
    'occupation_or_school' => 'encrypted',
    'emergency_contact_name' => 'encrypted',
    'emergency_contact_number' => 'encrypted',
    ];


}
