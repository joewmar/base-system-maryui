<?php

namespace Database\Seeders;

use App\Models\ElectricCost;
use App\Models\Farm;
use App\Models\FeedType;
use App\Models\Material;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Farm::factory(10)->create();
        User::factory(10)->create();
        Material::factory(10)->create();
        FeedType::factory(10)->create();
        ElectricCost::factory(10)->create();
    }
}
