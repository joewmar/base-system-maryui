<?php

namespace Database\Factories;

use App\Models\Farm;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FeedType>
 */
class FeedTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $farmIDs = Farm::all()->pluck('id')->toArray();
        return [
            'feed_type_name' => fake()->word(),
            'farm_id' => fake()->randomElement($farmIDs),
        ];
    }
}
