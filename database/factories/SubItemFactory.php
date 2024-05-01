<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\SubItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubItem>
 */
class SubItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = SubItem::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->city,
            'is_active' => $this->faker->boolean,
            'item_id' => Item::factory()->create()->id
        ];
    }
}
