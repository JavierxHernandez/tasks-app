<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrequenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('frequencies')->insert([
            [
                'name' => 'daily',
                'description' => 'Repeats every day',
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'weekly',
                'description' => 'Repeats every week',
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'monthly',
                'description' => 'Repeat every month',
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'yearly',
                'description' => 'Repeat every year',
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
