<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            ['name' => 'Dhaka','created_at' => now(),'updated_at' => now()],
            ['name' => 'Rajshahi','created_at' => now(),'updated_at' => now()],
            ['name' => 'Chittagong','created_at' => now(),'updated_at' => now()],
            ['name' => 'Bogura','created_at' => now(),'updated_at' => now()],
            ['name' => 'Sylhet','created_at' => now(),'updated_at' => now()],
        ]);
    }
}
