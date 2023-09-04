<?php

namespace Database\Seeders;

use App\Enum\UserType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'super admin',
            'email' => 'admin@admin.com',
            'type' => UserType::SUPER_ADMIN->value,
            'password' => Hash::make(123456789),
        ]);
    }
}
