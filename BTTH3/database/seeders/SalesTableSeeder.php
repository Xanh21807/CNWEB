<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sales')->insert([
            [
                'medicine_id' => 1, // Tham chiếu đến `medicines.id`
                'quantity' => 2,
                'sale_date' =>'2024-11-10',
                'customer_phone' => '0987654321',
            ],
            [
                'medicine_id' => 2,
                'quantity' => 1,
                'sale_date' => '2024-11-10',
                'customer_phone' => '0976543210',
            ],
            [
                'medicine_id' => 3,
                'quantity' => 3,
                'sale_date' => '2024-11-10',
                'customer_phone' => '0965432109',
            ],
        ]);
    }
}
