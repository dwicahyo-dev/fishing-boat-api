<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    protected $domainEmail = '@fishing-boat.com';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $superAdminRole = Role::create([
            'name' => 'super-admin',
            'guard_name' => 'api',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $userRole = Role::create([
            'name' => 'user',
            'guard_name' => 'api',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $userAdminUser = User::create([
            'name' => $faker->name,
            'email' =>  "super-admin{$this->domainEmail}",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $userAdminUser->assignRole('super-admin');
    }
}
