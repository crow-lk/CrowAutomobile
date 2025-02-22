<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_id', 'service_id', 'item_id', 'quantity', 'warranty_available',
        'warranty_type', 'price', 'is_service', 'is_item'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
