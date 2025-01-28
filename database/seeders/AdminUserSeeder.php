<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'fname' => 'Abhay',
            'lname'=>'Bhatti',
            'phone'=>'1234567890',
            'gender'=>'male',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
        ]);


    }
}
