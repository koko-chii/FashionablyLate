<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    public function definition(): array
{
    return [
        'category_id' => fake()->numberBetween(1, 5),
        'first_name' => fake()->lastName(),
        'last_name' => fake()->firstName(),
        'gender' => fake()->numberBetween(1, 3),
        'email' => fake()->safeEmail(),
        'tel' => fake()->phoneNumber(),
        'address' => fake()->address(),
        'building' => fake()->secondaryAddress(),
        'detail' => fake()->realText(200),
    ];
}
}
