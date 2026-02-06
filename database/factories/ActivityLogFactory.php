<?php

namespace Database\Factories;

use App\Models\ActivityLog;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActivityLog>
 */
class ActivityLogFactory extends Factory
{
    protected $model = ActivityLog::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model_type' => Product::class,
            'model_id' => 1,
            'action' => $this->faker->randomElement(['created', 'updated', 'deleted']),
            'old_values' => null,
            'new_values' => null,
            'user_id' => null,
            'ip_address' => $this->faker->ipv4(),
            'description' => $this->faker->sentence(),
        ];
    }
}
