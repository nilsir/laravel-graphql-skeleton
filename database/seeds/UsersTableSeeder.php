<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \App\Models\User::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $faker = \Faker\Factory::create();
        $password = bcrypt('password');

        \App\Models\User::create([
            'name'     => 'nilsir',
            'email'    => 'me@nilsir.com',
            'password' => $password,
        ]);

        for ($i = 0; $i < 10; ++$i) {
            \App\Models\User::create([
                'name'     => $faker->name,
                'email'    => $faker->email,
                'password' => $password,
            ]);
        }
    }
}
