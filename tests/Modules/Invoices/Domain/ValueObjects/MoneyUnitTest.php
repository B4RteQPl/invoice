<?php

namespace Tests\Modules\Invoices\Domain\ValueObjects;

use App\Domain\Enums\CurrencyEnum;
use App\Domain\ValueObjects\Currency;
use App\Domain\ValueObjects\Money;
use InvalidArgumentException;
use Tests\TestCase;

class MoneyUnitTest extends TestCase
{

    /** @test */
    public function can_set_positive_money(): void
    {
        self::assertEquals('10.00', Money::from(1000)->toString());
    }

    /**
     * @test
     * @dataProvider addDataProvider
     */
    public function can_set_zero_money(): void
    {
        self::assertEquals('0.00', Money::zero()->toString());
    }

    /** @test */
    public function can_set_negative_money(): void
    {
        self::assertEquals('-10.00', Money::from(-1000)->toString());
    }

    // add

    /**
     * @test
     * @dataProvider addDataProvider
     */
    public function can_add_money(Money $expected, Money $money, Money $moneyToAdd): void
    {
        // when
        $result = $money->add($moneyToAdd);

        // then
        self::assertEquals($expected, $result);
    }


    public function addDataProvider(): array
    {
        return [
            'for positive result' => [Money::from(1000), Money::from(500), Money::from(500)],
            'for zero' => [Money::from(0), Money::from(0), Money::from(0)],
            'for negative result' => [Money::from(-2), Money::from(-4), Money::from(2)],
        ];
    }

    // subtract

    /**
     * @test
     * @dataProvider subtractDataProvider
     */
    public function can_subtract_money(Money $expected, Money $money, Money $moneyToSubtract): void
    {
        // when
        $result = $money->subtract($moneyToSubtract);

        // then
        self::assertEquals($expected, $result);
    }

    /**
     * @test
     * @dataProvider subtractDataProvider
     */
    public function cannot_subtract_money_when_different_currency(Money $expected, Money $money, Money $moneyToSubtract): void
    {
        // expect
        $this->expectException(InvalidArgumentException::class);

        // given
        $money = Money::from(500, Currency::from(CurrencyEnum::PLN));
        $moneyWithSameCurrency = Money::from(500, Currency::from(CurrencyEnum::USD));

        // when
        $money->subtract($moneyWithSameCurrency);
    }

    /** @test */
    public function can_subtract_money_with_same_currency(): void
    {
        // given
        $money = Money::from(500, Currency::from(CurrencyEnum::USD));
        $moneyWithSameCurrency = Money::from(500, Currency::from(CurrencyEnum::USD));

        // when
        $result = $money->subtract($moneyWithSameCurrency);

        // then
        self::assertEquals(Money::zero(), $result);
    }

    public function subtractDataProvider(): array
    {
        return [
            'for positive result' => [Money::from(500), Money::from(1000), Money::from(500)],
            'for negative result' => [Money::from(-1), Money::from(2), Money::from(3)],
        ];
    }

    // multiply

    /**
     * @test
     * @dataProvider multiplyDataProvider
     */
    public function can_multiply_money(Money $money, int $multiplier, Money $expected): void
    {
        self::assertEquals($expected, $money->multiply($multiplier));
    }

    public function multiplyDataProvider(): array
    {
        return [
            'for positive integer' => [Money::from(1000), 2, Money::from(2000)],
            'for zero' => [Money::from(1000), 0, Money::zero()],
            'for negative integer' => [Money::from(1000), -1, Money::from(-1000)],
        ];
    }

    // percentage

    /**
     * @test
     * @dataProvider percentageDataProvider
     */
    public function can_percentage_money(Money $expected, Money $money, float $percentage): void
    {
        self::assertEquals($expected, $money->percentage($percentage));
    }

    public function percentageDataProvider(): array
    {
        return [
            'for floats' => [Money::from(15406), Money::from(14500), 106.25],
            'for zero' => [Money::from(0), Money::from(14500), 0],
            'for 50' => [Money::from(7250), Money::from(14500), 50],
            'for 100' => [Money::from(14500), Money::from(14500), 100],
        ];
    }
}
