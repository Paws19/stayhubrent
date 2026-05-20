<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $table = 'user_informations';

    protected $fillable = [
        'account_id',
        'first_name',
        'last_name',
        'phone_number',
        'address',
    ];

    protected $hidden = [
        'account_id',
    ];

   protected $casts = [
    'account_id' => 'integer',
    'first_name' => 'encrypted',
    'last_name' => 'encrypted',
    'phone_number' => 'encrypted',
    ];

}
