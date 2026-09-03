<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use App\Models\LandlordDetail;

class PaymentHistoryModel extends Model
{
    protected $table = 'payment_history';
    
    protected $fillable = [
        'account_id',
        'landlord_id',
        'transaction_id',
        'amount',
        'payment_method',
        'status',
        'month'
    ];

    public $timestamps = true;

    public function landlord()
    {
        return $this->belongsTo(LandlordDetail::class, 'landlord_id');
    }

    protected $casts = [
        'amount' => 'decimal:2',
       

    ];
}
