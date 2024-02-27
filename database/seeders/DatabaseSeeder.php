<?php

namespace Database\Seeders;

use App\Models\Farm;
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
        // DB::table('users')->insert([
        //     'id' => 1,
        //     'password' => null,
        //     'role' => 'superuser',
        // ]);
    }
}