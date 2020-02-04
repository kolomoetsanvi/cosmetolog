<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesDistrictsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities_districts')->insert(
           [
               [
                'cities_id'=>'1',
                'districts_id'=>'1',
                'created_at'=>'2019-07-01'
                ],
               [
                   'cities_id'=>'1',
                   'districts_id'=>'2',
                   'created_at'=>'2019-07-01'
               ],
               [
                   'cities_id'=>'1',
                   'districts_id'=>'3',
                   'created_at'=>'2019-07-01'
               ],
               [
                   'cities_id'=>'1',
                   'districts_id'=>'4',
                   'created_at'=>'2019-07-01'
               ],
               [
                   'cities_id'=>'1',
                   'districts_id'=>'5',
                   'created_at'=>'2019-07-01'
               ],
               [
                   'cities_id'=>'1',
                   'districts_id'=>'6',
                   'created_at'=>'2019-07-01'
               ]
           ]);
    }
}
