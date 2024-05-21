<?php

namespace App\Domain\ValueObjects;

use InvalidArgumentException;

class Money
{
    private int $price;
    private ?Currency $currency;
    private bool $withCurrency = false;

    private function __construct(int $price, ?Currency $currency = null)
    {
        $this->price = $price;
        $this->currency = $currency;
    }

    public static function from(int $price, ?Currency $currency = null): self
    {
        return new self($price, $currency);
    }

    public static function zero(): self
    {
        return new self(0);
    }

    public function add(self $other): self
    {
        $this->validateCurrency($other);

        return new self($this->price + $other->price);
    }

    public function subtract(self $other): self
    {
        $this->validateCurrency($other);

        return new self($this->price - $other->price);
    }

    public function multiply(int $multiplier): self
    {
        return new self($this->price * $multiplier);
    }

    public function percentage(float $percentage): self
    {
        return new self((int) round($percentage * $this->price/100));
    }

    public function toInt(): int
    {
        return $this->price;
    }

    public function toString(): string
    {
        $priceString = sprintf('%.2f', $this->price / 100);

        if ($this->withCurrency) {
            return $this->currency->toStringSign() . $priceString;
        }

        return $priceString;
    }

    private function validateCurrency(self $other): void
    {
        if ($this->currency && $other->currency && !$this->currency->equals($other->currency)) {
            throw new InvalidArgumentException('Currencies do not match');
        }
    }

    public function withCurrency(): self
    {
        $this->withCurrency = true;

        return $this;
    }
}
