<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
           
        [
            'name'=>'Mas Superadmin',
            'nip'=>'1111111',
            'unit'=>'Pacitan',
            'email'=>'superadmin@gmail.com',
            'role_id'=>'1',
            'password'=>bcrypt('superadmin@gmail.com')
        ]
    ];

    foreach ($userData as $key => $val) {
        User::create($val);
    }
    }
}
