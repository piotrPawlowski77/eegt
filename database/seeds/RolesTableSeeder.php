<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
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
            DB::table('roles')->insert([

                'user_id' => $faker->unique()->numberBetween(1,10),
                'role_name' => $faker->randomElement(['patient', 'admin']),

            ]);
        }
    }
}
