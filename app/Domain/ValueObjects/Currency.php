<?php

namespace App\Domain\ValueObjects;

use App\Domain\Enums\CurrencyEnum;

class Currency
{
    public CurrencyEnum $currency;

    private function __construct(CurrencyEnum $currency)
    {
        $this->currency = $currency;
    }

    public static function from(CurrencyEnum $currency): self
    {
        return new self($currency);
    }

    public static function default(): self
    {
        return new self(CurrencyEnum::USD);
    }

    public function toString(): string
    {
        return $this->currency->value;
    }

    public function toStringSign(): string
    {
        return match ($this->currency) {
            CurrencyEnum::USD => '$',

            // if sign is not available, return the currency
            default => $this->currency
        };
    }

    public function equals(self $other): bool
    {
        return $this->currency === $other->currency;
    }
}
