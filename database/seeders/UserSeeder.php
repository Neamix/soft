<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $managerRole = Role::where('name', 'manager')->first();
        $actorRole = Role::where('name', 'actor')->first();

        User::updateOrCreate(
        [
            'id' => 1
        ],
        [
            'name' => 'Manager',
            'email' => 'manager@soft.test',
            'password' => Hash::make('password123'),
            'role_id' => $managerRole->id,
            'email_verified_at' => now(),
        ]);

        User::updateOrCreate(
        [
            'id' => 2
        ],
        [
            'name' => 'Actor1',
            'email' => 'actor1@soft.test',
            'password' => Hash::make('password123'),
            'role_id' => $actorRole->id,
            'email_verified_at' => now(),
        ]);

        User::updateOrCreate(
        [
            'id' => 3
        ],
        [
            'name' => 'Actor2',
            'email' => 'actor2@soft.test',
            'password' => Hash::make('password123'),
            'role_id' => $actorRole->id,
            'email_verified_at' => now(),
        ]);

        User::updateOrCreate(
        [
            'id' => 4
        ],    
        [
            'name' => 'Actor3',
            'email' => 'actor3@soft.test',
            'password' => Hash::make('password123'),
            'role_id' => $actorRole->id,
            'email_verified_at' => now(),
        ]);

        User::updateOrCreate(
        [
            'id' => 4
        ],       
        [
            'name' => 'Actor4',
            'email' => 'actor4@soft.test',
            'password' => Hash::make('password123'),
            'role_id' => $actorRole->id,
            'email_verified_at' => now(),
        ]);
    }
}
