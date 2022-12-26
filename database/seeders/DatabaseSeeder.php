<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'optimal_production_speed' => '485'
        ]);
        DB::table('beers')->insert([
            'type' => 'Wheat',
            'max_speed' => '300',
            'optimal_production_speed' => '155'
        ]);
        DB::table('beers')->insert([
            'type' => 'IPA',
            'max_speed' => '150',
            'optimal_production_speed' => '101'
        ]);
        DB::table('beers')->insert([
            'type' => 'Stout',
            'max_speed' => '200',
            'optimal_production_speed' => '200'
        ]);
        DB::table('beers')->insert([
            'type' => 'Ale',
            'max_speed' => '100',
            'optimal_production_speed' => '85',
        ]);
        DB::table('beers')->insert([
            'type' => 'Alcohol Free',
            'max_speed' => '125',
            'optimal_production_speed' => '87'
        ]);

        DB::table('users')->insert([
            'name' => 'Nick',
            'password' => bcrypt('sha256'),
            'access_level' => '2'
        ]);
        DB::table('users')->insert([
            'name' => 'Alex',
            'password' => bcrypt('Sikkert_password'),
            'access_level' => '2'
        ]);
        DB::table('batches')->insert([
            'beer_id' => '1',
            'size' => '300',
            'user_id' => '1',
            'production_speed' => '300',
            'status' => '3'
        ]);
        DB::table('finished_batches')->insert([
            'batch_id'=>'1',
            'successful_products'=>'250',
            'failed_products' => '50'
        ]);

        DB::table('batches')->insert([
            'beer_id' => '2',
            'size' => '100',
            'user_id' => '2',
            'production_speed' => '100',
            'status' => '3'
        ]);

        DB::table('batches')->insert([
            'beer_id' => '3',
            'size' => '246',
            'user_id' => '1',
            'production_speed' => '200',
            'status' => '3'
        ]);


    }
}
