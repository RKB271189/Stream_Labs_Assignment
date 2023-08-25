<?php

namespace Database\Factories;

use App\Models\Donation;
use App\Models\MerchSale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Donation::class;
    public function definition(): array
    {
        $currency = ['CAD', 'USD', 'INR', 'EUR', 'GBP', 'AUD', 'JPY'];
        return [
            'name' => $this->faker->name,
            'amount' => floatval(rand(10, 10000) / 100),
            'currency' => $currency[array_rand($currency)],
            'donation_message' => $this->faker->sentence(),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'updated_at' => now(),
        ];
    }
}
