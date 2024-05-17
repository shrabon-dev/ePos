<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =  DB::table('users')->where('email', 'supper_admin@epos.com')->first();

        if (!$user) {
            // User does not exist, create a new one
            DB::table('users')->insert([
                'name' => 'shrabon',
                'email' => 'supper_admin@epos.com',
                'account_status' => 'active ',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password'),
                'created_at' => Carbon::now(),
            ]);
        }

    }
}
