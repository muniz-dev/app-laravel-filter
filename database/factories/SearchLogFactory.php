<?php

namespace Database\Factories;

use App\Models\SearchLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SearchLog>
 */
class SearchLogFactory extends Factory
{
    protected $model = SearchLog::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'search_term' => $this->faker->optional()->word(),
            'filters' => [
                'name' => $this->faker->optional()->word(),
                'categories' => [],
                'brands' => [],
            ],
            'results_count' => $this->faker->numberBetween(0, 100),
            'user_id' => null,
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
        ];
    }
}
