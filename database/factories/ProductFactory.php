<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $productNames = [
            'pen',
            'pencil',
            'razer',
            'gum',
            'towel',
            'backpack',
            'book',
            'shoes',
            'trousers',
            't-shirt',
            'snickers',
            'water',
            'coca-cola',
            'pepsi',
        ];

        return [
            'id' => Uuid::uuid4()->toString(),
            'name' => $productNames[array_rand($productNames)],
            'price' => rand(1111, 9999999),
            'currency' => 'usd',
        ];
    }
}
