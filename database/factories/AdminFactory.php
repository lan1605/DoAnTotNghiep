<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(Faker $faker)
    {
        return [
            'name' => $faker->username,
            'password' => Hash::make(12345678),         
            'email' => $faker->unique()->safeEmail,
            'role_id' => App\Models\Role::all()->random()->id,
        ];
    }
}
