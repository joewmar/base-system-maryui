<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RawMaterialItem>
 */
class RawMaterialItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['micro', 'macro', 'medicine'];
        return [
            'material_name' => fake()->word(),
            'category' => fake()->randomElement($categories),

        ];
    }
}
