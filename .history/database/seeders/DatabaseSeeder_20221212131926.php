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
            'name' => 'Pilsner',
            'production_speed' => '1',
            'recipe' => '1'
        ]);
        DB::table('beers')->insert([
            'name' => 'Wheat',
            'production_speed' => '2',
            'recipe' => '2'
        ]);
        DB::table('beers')->insert([
            'name' => 'IPA',
            'production_speed' => '3',
            'recipe' => '3'
        ]);
        DB::table('beers')->insert([
            'name' => 'Stout',
            'production_speed' => '4',
            'recipe' => '4'
        ]);
        DB::table('beers')->insert([
            'name' => 'Ale',
            'production_speed' => '5',
            'recipe' => '5'
        ]);
        DB::table('beers')->insert([
            'name' => 'Alcohol Free',
            'production_speed' => '6',
            'recipe' => '6'
        ]);

    }
}
