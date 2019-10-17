<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,5) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'created_at' => now(),
                'email_verified_at' => now(),
                'role_id' => $faker->numberBetween(1, 2),
                'password' => bcrypt('123456789'),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
