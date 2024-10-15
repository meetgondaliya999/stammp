<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->truncate();
        
        $admins = [
            [
                'name'              => 'Admin',
                'email'             => 'admin@gmail.com',
                'password'          => Hash::make('123456'),
                'type'              =>'super_admin',
                'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'        => \Carbon\Carbon::now()->toDateTimeString()
            ]
        ];

        if (!DB::table('admins')->count()) {
            DB::table('admins')->insert($admins);
        }
    }
}
