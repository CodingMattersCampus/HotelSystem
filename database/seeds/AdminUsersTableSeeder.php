<?php

declare(strict_types = 1);

use App\Models\User\User;
use App\Models\User\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

final class AdminUsersTableSeeder extends Seeder
{
    public function run() : void
    {
        if (!User::whereUsername('admin')->first())
            User::firstOrCreate([
                'code'      => Uuid::uuid4()->toString(),
                'username'  => 'admin',
                'name'      => "Admin User",
                'password'  => Hash::make('secret'),
                'api_token' => str_random(100),
                'is_active' => true,
                'role'      => UserRole::ADMINISTRATOR,
            ]);

        if (!User::whereUsername('william')->first())
            User::firstOrCreate([
                'code'      => Uuid::uuid4()->toString(),
                'username'  => 'william',
                'name'      => "William",
                'password'  => Hash::make('secret'),
                'api_token' => str_random(100),
                'is_active' => true,
                'role'      => UserRole::ADMINISTRATOR,
            ]);

        if (!User::whereUsername('laila')->first())
            User::firstOrCreate([
                'code'      => Uuid::uuid4()->toString(),
                'username'  => 'laila',
                'name'      => "Laila",
                'password'  => Hash::make('secret'),
                'api_token' => str_random(100),
                'is_active' => true,
                'role'      => UserRole::MANAGER,
            ]);

        if (!User::whereUsername('kim')->first())
            User::firstOrCreate([
                'code'      => Uuid::uuid4()->toString(),
                'username'  => 'kim',
                'name'      => "Kim",
                'password'  => Hash::make('secret'),
                'api_token' => str_random(100),
                'is_active' => true,
                'role'      => UserRole::MANAGER,
            ]);
    }
}
