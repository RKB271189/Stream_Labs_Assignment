<?php

namespace Database\Factories;

use App\Models\MerchSale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MerchSaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = MerchSale::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'item_name' => $this->faker->word(),
            'amount' => floatval(rand(10, 10000) / 100),
            'price' => floatval(rand(10, 1500) / 100),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'updated_at' => now(),
        ];
    }
}
