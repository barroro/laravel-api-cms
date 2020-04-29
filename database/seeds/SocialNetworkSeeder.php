<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialNetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('social_networks')->delete();
        DB::table('social_networks')->insert([
            [
                'icon' => 'pinterest',
                'title' => 'Pinterest',
                'color' => '#e60023',
                'url' => 'https:\\www.test.com'
            ],
            [
                'icon' => 'instagram',
                'title' => 'Instagram',
                'color' => '#323232',
                'url' => 'https:\\www.test.com'
            ],
            [
                'icon' => 'twitter',
                'title' => 'Twitter',
                'color' => '#1da1f2',
                'url' => 'https:\\www.test.com'
            ]
        ]);
    }
}
