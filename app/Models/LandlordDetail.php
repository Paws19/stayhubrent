<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandlordDetail extends Model
{
    protected $table = 'landlord_details';

    protected $fillable = [
        'account_id',
        'property_name',
        'property_type',
        'number_of_floors',
        'number_of_rooms',
        'bed_per_room',
        'monthly_rent',
        'full_address',
        'amenities',
        'house_rules',
    ];

    protected $hidden = [
        'account_id',
    ];

  protected $casts = [
    'amenities' => 'array',
    'full_address' => 'encrypted',
    'property_name' => 'encrypted',
];
}
