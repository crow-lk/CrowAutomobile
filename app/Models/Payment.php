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

    protected static function booted()
    {
        static::creating(function ($payment) {
            $invoice = Invoice::find($payment->invoice_id);

            // Reduce stock
            $invoice->decrement('credit_balance', $payment->amount_paid);
        });

        // Restore stock if the payment is deleted
        static::deleting(function ($payment) {
            $payment->invoice->increment('credit_balance', $payment->amount_paid);
        });
    }
}
