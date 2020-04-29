<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        DB::table('categories')->insert([
            [
                'name' => 'Branding',
                'description' => 'Branding',
            ],
            [
                'name' => 'Editorial',
                'description' => 'Editorial',
            ],
            [
                'name' => 'Campañas',
                'description' => 'Campañas',
            ],
            [
                'name' => 'Digital',
                'description' => 'Digital',
            ],
            [
                'name' => 'Otros',
                'description' => 'Otros',
            ]
        ]);
    }
}
