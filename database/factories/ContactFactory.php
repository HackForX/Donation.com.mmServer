<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'id'=>'1',
            'phone' => '09783150477',
            'email' => 'linnayye557@gmail.com',
            'facebook'=>'facebook.com',
            'website'=>'website.com'
        ];
    }
}
