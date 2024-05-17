<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('site_settings')->insert([
            'name' => 'company_name',
            'value' => 'EPOS',
            'created_at' => Carbon::now(),
        ]);
        DB::table('site_settings')->insert([
            'name' => 'mobile',
            'value' => '+880 12365478',
            'created_at' => Carbon::now(),
        ]);
        DB::table('site_settings')->insert([
            'name' => 'email',
            'value' => 'email@gmail.com',
            'created_at' => Carbon::now(),
        ]);
        DB::table('site_settings')->insert([
            'name' => 'company_logo',
            'value' => '',
            'created_at' => Carbon::now(),
        ]);

    }
}
