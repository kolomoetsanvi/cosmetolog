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
        // $this->call(CitiesSeeder::class);
         //$this->call(DistrictSeeder::class);
         //$this->call(CitiesDistrictsSeeder::class);
         //$this->call(PersonnelSeeder::class);
        // $this->call(CosmetologiesSeeder::class);
       // $this->call(CosmetologiesPersonnelSeeder::class);
        //$this->call(ServicesSeeder::class);
       // $this->call(PricesSeeder::class);
        $this->call(ArticlesSeeder::class);
    }
}
