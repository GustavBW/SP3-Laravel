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
            'type' => 'Wheat',
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
        DB::table('beers')->insert([
            'type' => 'Stout',
            'production_speed_id' => '4',
            'optimal_production_speed' => '4',
            'recipe_id' => '4'
        ]);
        DB::table('beers')->insert([
            'type' => 'Ale',
            'production_speed_id' => '5',
            'optimal_production_speed' => '5',
            'recipe_id' => '5'
        ]);
        DB::table('beers')->insert([
            'type' => 'Alcohol Free',
            'production_speed_id' => '6',
            'optimal_production_speed' => '6',
            'recipe_id' => '6'
        ]);

        DB::table('recipes')->insert([
            'barley' => '4',
            'hops' => '2',
            'malt' => '1',
            'yeast' => '4',
            'wheat' => '1'
        ]);
        DB::table('recipes')->insert([
            'barley' => '1',
            'hops' => '4',
            'malt' => '1',
            'yeast' => '3',
            'wheat' => '6'
        ]);
        DB::table('recipes')->insert([
            'barley' => '4',
            'hops' => '1',
            'malt' => '5',
            'yeast' => '1',
            'wheat' => '4'
        ]);
        DB::table('recipes')->insert([
            'barley' => '3',
            'hops' => '4',
            'malt' => '6',
            'yeast' => '2',
            'wheat' => '1'
        ]);
        DB::table('recipes')->insert([
            'barley' => '4',
            'hops' => '6',
            'malt' => '2',
            'yeast' => '8',
            'wheat' => '2'
        ]);
        DB::table('recipes')->insert([
            'barley' => '1',
            'hops' => '1',
            'malt' => '4',
            'yeast' => '0',
            'wheat' => '5'
        ]);
        
        $penis = new IngredientsController();
        $penis->ingredientsFill();


    }
}
