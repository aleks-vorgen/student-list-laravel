<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faculties = [
            [
                'title' => 'ЭлИТ',
                'work_time' => '33000',
            ],
            [
                'title' => 'ТЕСЕТ',
                'work_time' => '30000',
            ],
            [
                'title' => 'БЭМ',
                'work_time' => '40000',
            ],
            [
                'title' => 'ИФСК',
                'work_time' => '43000',
            ],
        ];

        DB::table('faculties')->insert($faculties);
    }
}
