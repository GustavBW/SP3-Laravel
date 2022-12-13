<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\IngredientsController;

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
            'max_speed' => '600',
            'optimal_production_speed' => '1'
        ]);
        DB::table('beers')->insert([
            'type' => 'Wheat',
            'max_speed' => '300',
            'optimal_production_speed' => '2'
        ]);
        DB::table('beers')->insert([
            'type' => 'IPA',
            'max_speed' => '150',
            'optimal_production_speed' => '3'
        ]);
        DB::table('beers')->insert([
            'type' => 'Stout',
            'max_speed' => '200',
            'optimal_production_speed' => '4'
        ]);
        DB::table('beers')->insert([
            'type' => 'Ale',
            'max_speed' => '100',
            'optimal_production_speed' => '5',
        ]);
        DB::table('beers')->insert([
            'type' => 'Alcohol Free',
            'max_speed' => '125',
            'optimal_production_speed' => '6'
        ]);

    }
}
