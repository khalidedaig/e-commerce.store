<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRole;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(1)->create([
            'name' => 'Dev',
            'email' => 'dev@alten.com',
            'password' => Hash::make('dev@alten.comA1'),
            'role' => UserRole::SUPER_ADMIN,
        ]);
    }
}
