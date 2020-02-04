<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert(
            [
                [//1
                    'title'=>'Чистка атравматическая',
                    'created_at'=>'2019-07-01'
                ],
                [//2
                    'title'=>'Чистка вакуумная',
                    'created_at'=>'2019-07-01'
                ],
                [//3
                    'title'=>'Чистка механическая',
                    'created_at'=>'2019-07-01'
                ],
                [//4
                    'title'=>'Чистка ультразвуковая',
                    'created_at'=>'2019-07-01'
                ],
                [//5
                    'title'=>'Чистка комбинированная',
                    'created_at'=>'2019-07-01'
                ],
                [//6
                    'title'=>'Косметический массаж: пластический',
                    'created_at'=>'2019-07-01'
                ],
                [//7
                    'title'=>'Косметический массаж: аппаратный',
                    'created_at'=>'2019-07-01'
                ],
                [//8
                    'title'=>'Косметические маски различных видов',
                    'created_at'=>'2019-07-01'
                ],
                [//9
                    'title'=>'Чистка комбинированная',
                    'created_at'=>'2019-07-01'
                ],
                [//10
                    'title'=>'Очищающие процедуры (тело): скрабинг',
                    'created_at'=>'2019-07-01'
                ],
                [//11
                    'title'=>'Очищающие процедуры (тело): пилинг',
                    'created_at'=>'2019-07-01'
                ],
                [//12
                    'title'=>'Комплексный уход за кожей кистей рук и кожей стоп',
                    'created_at'=>'2019-07-01'
                ],
                [//13
                    'title'=>'Гидромассаж',
                    'created_at'=>'2019-07-01'
                ],
                [//14
                    'title'=>'Лимфодренаж',
                    'created_at'=>'2019-07-01'
                ],
                [//15
                    'title'=>'Эпиляция',
                    'created_at'=>'2019-07-01'
                ]
            ]);
    }
}
