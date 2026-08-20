<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable

{

    use Notifiable;
    protected $table = 'accounts';

    protected $fillable = [
        'email',
        'email_verified_at',
        'verification_token',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'verification_token',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
