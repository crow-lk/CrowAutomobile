<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'invoice_id',
        'amount_paid',
        'payment_method',
        'reference_number',
        'payment_date',
        'notes',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
