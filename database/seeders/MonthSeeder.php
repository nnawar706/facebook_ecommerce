<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('months')->insert([
            ['name' => 'January','created_at' => now(),'updated_at' => now()],
            ['name' => 'February','created_at' => now(),'updated_at' => now()],
            ['name' => 'March','created_at' => now(),'updated_at' => now()],
            ['name' => 'April','created_at' => now(),'updated_at' => now()],
            ['name' => 'May','created_at' => now(),'updated_at' => now()],
            ['name' => 'June','created_at' => now(),'updated_at' => now()],
            ['name' => 'July','created_at' => now(),'updated_at' => now()],
            ['name' => 'August','created_at' => now(),'updated_at' => now()],
            ['name' => 'September','created_at' => now(),'updated_at' => now()],
            ['name' => 'October','created_at' => now(),'updated_at' => now()],
            ['name' => 'November','created_at' => now(),'updated_at' => now()],
            ['name' => 'December','created_at' => now(),'updated_at' => now()],
        ]);
    }
}
