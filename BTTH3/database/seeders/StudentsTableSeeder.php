<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) { // Tạo 50 học sinh
            DB::table('students')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'date_of_birth' => $faker->date('Y-m-d', '2015-12-31'), // Ngày sinh trước năm 2015
                'parent_phone' => $faker->numerify('##########'), // Số điện thoại 10 chữ số
                'class_id' => $faker->numberBetween(1, 10), // Random class_id từ 1 đến 10
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
