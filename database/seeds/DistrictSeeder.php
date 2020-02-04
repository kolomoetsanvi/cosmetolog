<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('districts')->insert(
            [
                [
                     'title'=>'Левобережный',
                     'created_at'=>'2019-07-01'
                ],
                [
                    'title'=>'Железнодорожный',
                    'created_at'=>'2019-07-01'
                ],
                [
                    'title'=>'Советский',
                    'created_at'=>'2019-07-01'
                ],
                [
                    'title'=>'Ленинский',
                    'created_at'=>'2019-07-01'
                ],
                [
                    'title'=>'Центральный',
                    'created_at'=>'2019-07-01'
                ],
                [
                    'title'=>'Коминтерновский',
                    'created_at'=>'2019-07-01'
                ]

            ]);
    }
}
