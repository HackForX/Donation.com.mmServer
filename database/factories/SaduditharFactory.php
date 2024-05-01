<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\City;
use App\Models\SubCategory;
use App\Models\Township;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sadudithar>
 */
class SaduditharFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->sentence(10),
            'category_id' => Category::factory()->create()->id,

            'city_id' => City::factory()->create()->id,
            'township_id' => Township::factory()->create()->id,
            'user_id' => User::factory()->create()->id, // Set user_id to null or use a factory if applicable
            'subCategory_id' => SubCategory::factory()->create()->id, // Set subCategory_id to null or use a factory if applicable
            'estimated_amount' => $this->faker->randomFloat(2, 100, 1000),
            'estimated_time' => $this->faker->time(),
            'estimated_quantity' => $this->faker->numberBetween(1, 10),
            'event_date' => $this->faker->date(),
            'is_open' => $this->faker->boolean(),
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'image' => $this->faker->imageUrl(640, 480),
            'status' => $this->faker->word,
            'latitude' => null,
            'longitude' => null,
        ];
    }
}
