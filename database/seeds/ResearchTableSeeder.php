<?php

use Illuminate\Database\Seeder;

class ResearchTableSeeder extends Seeder
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
            DB::table('research')->insert([

                'research_name' => $faker->unique()->word,
                'description' => $faker->text(50),
                'research_date' => $faker->dateTimeBetween('now', '+10 days'),
                'availability' => $faker->boolean(50),

            ]);
        }
    }
}
