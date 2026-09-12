<?php

namespace App\Models\Landlord;

use Illuminate\Database\Eloquent\Model;
use App\Models\LandlordDetail;

class NewApartmentModel extends Model
{
    protected $table = 'new_apartment';

   protected $fillable = [
    'account_id',
    'apartment_name',
    'room_name',
    'room_type',
    'apartment_address',
    'apartment_image',
    'monthly_rent',
    'total_beds_in_room',
    'available_beds_in_room',
    'amenities',
    'latitude',
    'longitude',
];

    public $timestamps = true;

    public function landlord()
    {
        return $this->belongsTo(LandlordDetail::class, 'account_id');
    }

    //hidden the location of the apartment
    protected $hidden = [
        'latitude',
        'longitude',
    ];

    //amenities is stored as a JSON string in the database, so we need to cast it to an array when retrieving it
    protected $casts = [
        'amenities' => 'array',
    ];

    
}
