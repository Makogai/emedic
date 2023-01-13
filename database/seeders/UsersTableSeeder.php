<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'verified'           => 1,
                'verified_at'        => '2023-01-13 15:13:12',
                'verification_token' => '',
                'registration_code'  => '',
                'phone_number'       => '',
                'jmbg'               => '',
            ],
        ];

        User::insert($users);
    }
}
