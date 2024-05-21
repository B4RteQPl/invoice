<?php

namespace App\Models;

use App\Domain\ValueObjects\Money;
use App\Models\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'string',
        'price' => MoneyCast::class,
    ];

    public function invoiceProductLines(): HasMany
    {
        return $this->hasMany(InvoiceProductLine::class);
    }

    public function priceWithCurrency(): Money
    {
        if ($this->currency === null) {
            return Money::from($this->price);
        }

        return Money::from($this->price, $this->currency);
    }
}
