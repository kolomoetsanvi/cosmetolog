<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personnel')->insert(
            [
                [
                    'surname'=>'Оллито',
                     'name'=>'Людмила',
                     'patronymic'=>'Борисовна',
                     'created_at'=>'2019-07-01'
                ],
                [
                    'surname'=>'Косарева',
                    'name'=>'Ольга',
                    'patronymic'=>'Владимировна',
                    'created_at'=>'2019-07-01'
                ],
                [
                    'surname'=>'Хамидова',
                    'name'=>'Лариса',
                    'patronymic'=>'Махмутсалаховна',
                    'created_at'=>'2019-07-01'
                ],
                [
                    'surname'=>'Трифанова',
                    'name'=>'Светлана',
                    'patronymic'=>'Николаевна',
                    'created_at'=>'2019-07-01'
                ],
                [
                    'surname'=>'Каханова',
                    'name'=>'Александра',
                    'patronymic'=>'Григорьевна',
                    'created_at'=>'2019-07-01'
                ],
                [
                    'surname'=>'Дмитриева',
                    'name'=>'Антонина',
                    'patronymic'=>'Владимировна',
                    'created_at'=>'2019-07-01'
                ],
                [
                    'surname'=>'Жилякова',
                    'name'=>'Виктория',
                    'patronymic'=>'Николаевна',
                    'created_at'=>'2019-07-01'
                ],
                [
                    'surname'=>'Романова',
                    'name'=>'Людмила',
                    'patronymic'=>'Александровна',
                    'created_at'=>'2019-07-01'
                ],
                [
                    'surname'=>'Болдырева',
                    'name'=>'Ирина',
                    'patronymic'=>'Васильевна',
                    'created_at'=>'2019-07-01'
                ],
                [
                    'surname'=>'Самофалова',
                    'name'=>'Юлия',
                    'patronymic'=>'Сергеевна',
                    'created_at'=>'2019-07-01'
                ],
            ]);
    }
}
