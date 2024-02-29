<?php

namespace Database\Seeders;

use App\Models\Farm;
use App\Models\FeedType;
use App\Models\RawMaterialItem;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        RawMaterialItem::factory(10)->create();
        FeedType::factory(10)->create();
    }
}
