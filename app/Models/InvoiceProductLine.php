<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceProductLine extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'string',
    ];

    //    public function invoice(): BelongsTo
    //    {
    //        return $this->belongsTo(Invoice::class);
    //    }
    //
    //    public function product(): BelongsTo
    //    {
    //        return $this->belongsTo(Product::class);
    //    }
}
