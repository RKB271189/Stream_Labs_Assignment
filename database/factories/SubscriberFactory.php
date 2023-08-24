<?php

namespace Database\Factories;

use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SubscriberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Subscriber::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'subscription_tier' => rand(1, 3),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'updated_at' => now(),
        ];
    }
}
