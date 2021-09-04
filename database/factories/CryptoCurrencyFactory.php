<?php

namespace Database\Factories;

use App\Models\CryptoCurrency;
use Illuminate\Database\Eloquent\Factories\Factory;

class CryptoCurrencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CryptoCurrency::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'symbol' => $this->faker->currencyCode,
            'last_price' => $this->faker->randomFloat(),
            'daily_change' => $this->faker->randomFloat(),
            'daily_change_percent' => $this->faker->randomFloat(),
            'daily_high' => $this->faker->randomFloat(),
            'daily_low' => $this->faker->randomFloat(),
        ];
    }
}
