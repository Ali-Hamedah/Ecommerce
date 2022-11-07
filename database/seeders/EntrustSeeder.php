<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EntrustSeeder extends Seeder
{

    public function run()
    {
        $faker = Factory::create();

        $adminRole = Role::create(['name' => 'admin', 'display_name' => 'Administration', 'description' => 'Administrator', 'allowed_route' => 'admin',]);
        $supervisorRole = Role::create(['name' => 'supervisor', 'display_name' => 'Supervisor', 'description' => 'Supervisor', 'allowed_route' => 'admin',]);
        $customerRole = Role::create(['name' => 'customer', 'display_name' => 'Customer', 'description' => 'Customer', 'allowed_route' => null,]);

        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'System',
            'username' => 'admin',
            'email' => 'admin@ecommerce.test',
            'email_verified_at' => now(),
            'mobile' => '43000000000',
            'password' => bcrypt('12345678'),
            'user_image' => 'avatar.svg',
            'status' => 1,
            'remember_token' => Str::random(10),

        ]);
        $admin->attachRole($adminRole);


        $supervisor = User::create([
            'first_name' => 'Supervisor',
            'last_name' => 'System',
            'username' => 'supervisor',
            'email' => 'supervisor@ecommerce.test',
            'email_verified_at' => now(),
            'mobile' => '43000000001',
            'password' => bcrypt('12345678'),
            'user_image' => 'avatar.svg',
            'status' => 1,
            'remember_token' => Str::random(10),

        ]);
        $supervisor->attachRole($supervisor);


        $customer = User::create([
            'first_name' => 'Ali',
            'last_name' => 'Hamedah',
            'username' => 'ali',
            'email' => 'ali@gmail.com',
            'email_verified_at' => now(),
            'mobile' => '43000000002',
            'password' => bcrypt('12345678'),
            'user_image' => 'avatar.svg',
            'status' => 1,
            'remember_token' => Str::random(10),

        ]);
        $customer->attachRole($customerRole);

        for ($i = 1; $i <= 20; $i++) {
            $random_customer = User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => $faker->userName,
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'mobile' => $faker->numberBetween(1000000, 9999999),
                'password' => bcrypt('12345678'),
                'user_image' => 'avatar.svg',
                'status' => 1,
                'remember_token' => Str::random(10),

            ]);
            $random_customer->attachRole($customerRole);
        }


    }
}
