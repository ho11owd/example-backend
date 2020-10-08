<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            User::create([
                'name'           => 'Admin',
                'email'          => 'admin@example.local',
                'password'       => bcrypt('test1234'),
                'remember_token' => Str::random(60),
                'is_admin'       => true
            ]);
            User::create([
                'name'           => 'Tester',
                'email'          => 'tester@example.local',
                'password'       => bcrypt('password01'),
                'remember_token' => Str::random(60),
                'is_admin'       => false
            ]);
            User::create([
                'name'           => 'Tester_02',
                'email'          => 'tester_02@example.local',
                'password'       => bcrypt('password01'),
                'remember_token' => Str::random(60),
                'is_admin'       => true
            ]);
        }
    }
}
