<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\UserController::factory(10)->create();

        // \App\Models\UserController::factory()->create([
        //     'name' => 'Test UserController',
        //     'email' => 'test@example.com',
        // ]);  
        DB::table('beers')->insert([
            'type' => 'Pilsner',
            'production_speed_id' => '1',
            'optimal_production_speed' => '1',
            'recipe_id' => '1'
        ]);
        DB::table('beers')->insert([
            'type = ' => 'Wheat',
            'production_speed_id' => '2',
            'optimal_production_speed' => '2',
            'recipe_id' => '2'
        ]);
        DB::table('beers')->insert([
            'type' => 'IPA',
            'production_speed_id' => '3',
            'optimal_production_speed' => '3',
            'recipe_id' => '3'
        ]);

    }
}
