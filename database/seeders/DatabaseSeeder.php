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
            'name' => 'Nick Er Sej',
            'password' => bcrypt('penis'),
            'access_level' => '2'
        ]);
        DB::table('users')->insert([
            'name' => 'Alex',
            'password' => bcrypt('penis'),
            'access_level' => '2'
        ]);
        DB::table('batches')->insert([
            'beer_id' => '1',
            'size' => '2',
            'user_id' => '3',
            'production_speed' => '4',
            'status' => '3'
        ]);
        DB::table('finished_batches')->insert([
            'batch_id'=>'1',
            'successful_products'=>'2',
            'failed_products' => '3'
        ]);

        DB::table('batches')->insert([
            'beer_id' => '2',
            'size' => '10',
            'user_id' => '1',
            'production_speed' => '10',
            'status' => '3'
        ]);

        DB::table('batches')->insert([
            'beer_id' => '3',
            'size' => '20',
            'user_id' => '20    ',
            'production_speed' => '20',
            'status' => '3'
        ]);


    }
}
