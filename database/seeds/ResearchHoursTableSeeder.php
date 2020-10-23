<?php

use Illuminate\Database\Seeder;

class ResearchHoursTableSeeder extends Seeder
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
            DB::table('research_hours')->insert([

                'research_id' => $faker->unique()->numberBetween(1,10),
                'hour' => $faker->unique()->time('H:i','15:00'),
                'availability' => $faker->boolean(50),
                'research_code' => $faker->numberBetween(0,0),
            ]);
        }
    }
}
