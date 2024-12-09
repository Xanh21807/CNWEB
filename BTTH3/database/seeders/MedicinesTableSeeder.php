<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MedicinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('medicines')->insert([
            [
                'name' => 'Paracetamol 500mg',
                'brand' => 'PharmaCorp',
                'dosage' => '500mg',
                'form' => 'Tablet',
                'price' => 2000.50,
                'stock' => 100,
            ],
            [
                'name' => 'Ibuprofen 200mg',
                'brand' => 'MediHeal',
                'dosage' => '200mg',
                'form' => 'Capsule',
                'price' => 3500.75,
                'stock' => 50,
            ],
            [
                'name' => 'Amoxicillin 250mg',
                'brand' => 'HealthPlus',
                'dosage' => '250mg',
                'form' => 'Syrup',
                'price' => 1500.00,
                'stock' => 200,
            ],
        ]);
    }
}
