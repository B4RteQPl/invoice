<?php

namespace App\Models\Casts;

use App\Domain\ValueObjects\Money;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class MoneyCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return Money::from($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value->getAmount();
    }
}
