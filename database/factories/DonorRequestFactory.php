<?php

namespace Database\Factories;

use App\Models\DonorRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DonorRequest>
 */
class DonorRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model=DonorRequest::class;
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name(),
            'phone'=>$this->faker->phoneNumber(),
            'address'=>$this->faker->address(),
            'document'=>$this->faker->image(),
            'document_number'=>$this->faker->randomNumber(),
            'user_id' => User::factory()->create()->id,
            'status'=>'pending'

        ];
    }
}
