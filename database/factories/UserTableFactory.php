<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\user>
 */
class UserTableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'name'=>$this->faker->name,
                'password'=>$this->faker->title,
                'email'=>$this->faker->,
                'address'=>$this->faker->text,
                'phone'=>$this->faker->unique()->numerify('##########'),
        ];
    }
}
