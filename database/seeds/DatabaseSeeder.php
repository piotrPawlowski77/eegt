<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(RolesTableSeeder::class);
         $this->call(ResearchTableSeeder::class);
         $this->call(ResearchHoursTableSeeder::class);
         $this->call(VisitsTableSeeder::class);
    }
}
