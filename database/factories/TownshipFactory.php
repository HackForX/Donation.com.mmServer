<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Township;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Township>
 */
class TownshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Township::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->city,
            'is_active' => $this->faker->boolean,
            'city_id' => City::factory()->create()->id,
            'city_name' => City::factory()->create()->name,

        ];
    }
}
