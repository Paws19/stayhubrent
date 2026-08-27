<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceRequestModel extends Model
{
    protected $table = 'maintenance_request_tbl';

    protected $fillable = [
        'account_id',
        'request_title',
        'request_description',
        'request_image',
        'request_status',
      
    ];

    protected $hidden = [
        'account_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',

    ];
}
