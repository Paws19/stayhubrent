<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserInformation;
use App\Models\LandlordDetail;

class AssignApartmentModel extends Model
{
    protected $table = 'tenant_assign_apartment';

    protected $fillable = [
        'account_id',
        'apartment_id',
        'move_in_date',
        'move_out_date',
        'status'
    ];

    public $timestamps = true;

    public function tenant()
    {
        return $this->belongsTo(UserInformation::class, 'account_id');
    }

    public function apartment()
    {
        return $this->belongsTo(LandlordDetail::class, 'apartment_id');
    }
}
