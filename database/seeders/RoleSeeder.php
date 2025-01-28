<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role=[
            ['title'=>'Admin','status'=>1],
            ['title'=>'Doctor','status'=>1],
            ['title'=>'Patient','status'=>1],
        ];
        Role::insert($role);
    }
}
