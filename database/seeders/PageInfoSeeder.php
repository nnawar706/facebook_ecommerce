<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('page_info')->insert([
            'page_id' => '274125533306274',
            'app_id' => '352473955313682',
            'secret_key' => '7f59fb5b11ace6041b6c16b4c6a15301',
        ]);
    }
}
