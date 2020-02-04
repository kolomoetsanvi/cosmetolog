<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('cities')->insert(
                   [
                       'citie'=>'Воронеж',
                       'created_at'=>'2019-07-01'
                    ]);
   }
}
