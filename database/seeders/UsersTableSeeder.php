<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insertar usuarios con diferentes roles
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'usertype' => 'admin',
                'email_verified_at' => null,
                'password' => Hash::make('admin1234'), // Contraseña segura
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'usertype' => 'user',
                'email_verified_at' => null,
                'password' => Hash::make('user1234'), // Contraseña segura
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@example.com',
                'usertype' => 'manager',
                'email_verified_at' => null,
                'password' => Hash::make('manager1234'), // Contraseña segura
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Support',
                'email' => 'support@example.com',
                'usertype' => 'support',
                'email_verified_at' => null,
                'password' => Hash::make('support1234'), // Contraseña segura
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Consultant',
                'email' => 'consultant@example.com',
                'usertype' => 'consultant',
                'email_verified_at' => null,
                'password' => Hash::make('consultant1234'), // Contraseña segura
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Client',
                'email' => 'client@example.com',
                'usertype' => 'client',
                'email_verified_at' => null,
                'password' => Hash::make('client1234'), // Contraseña segura
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
}}
