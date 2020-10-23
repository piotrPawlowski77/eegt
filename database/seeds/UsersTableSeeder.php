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
        $faker = Faker\Factory::create('pl_PL');    //pl_PL spowoduje ze dane bd polskie

        for($i =1; $i<=10; $i++)
        {
            DB::table('users')->insert([

                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'nr_indeksu' => $faker->numberBetween(89054,99999),
                'email' => $faker->email,
                'password' => bcrypt('password'),

            ]);
        }

    }
}
