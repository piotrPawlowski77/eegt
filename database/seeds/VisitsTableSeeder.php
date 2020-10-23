<?php

use Illuminate\Database\Seeder;

class VisitsTableSeeder extends Seeder
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
            DB::table('visits')->insert([

                'user_id' => $faker->numberBetween(1,10),
                'research_id' => $faker->unique()->numberBetween(1,10),
                'research_code' => $faker->numberBetween(0,0),
            ]);
        }
    }
}
