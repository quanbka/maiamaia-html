<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=1; $i <= 100; $i++) {
            $length = 32;
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt($faker->text),
                'api_token' => substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length),
            ]);
            echo ("Created $i users!\n");
        }
    }
}
