<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ComputersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('computers')->insert([
                'computer_name' => 'Lab-' . $faker->unique()->numerify('PC##'),
                'model' => $faker->randomElement(['Dell Optiplex 7090', 'HP EliteDesk 800 G6']),
                'operating_system' => $faker->randomElement(['Windows 10 Pro', 'Ubuntu 22.04']),
                'processor' => $faker->randomElement(['Intel Core i5-11400', 'AMD Ryzen 5 5600G']),
                'memory' => $faker->randomElement([8, 16, 32]),
                'available' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
