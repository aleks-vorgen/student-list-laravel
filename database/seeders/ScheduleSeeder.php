<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $schedule = [];

        $hour = 8;
        $minute = 30;

        for ($i = 1; $i <= 6; $i++) {
            $cTitle = "Предмет №".$i;

            if ($minute >= 60) {
                $hour += 1;
                $minute -= 60;
            }

            if ($hour == 13) {
                $hour += 1;
                $minute -= 15;
            }

            $cDate_time_begin = Date::create(2021, 9, 24, $hour, $minute);
            $cDate_time_end = Date::create(2021, 9, 24, $hour += 1, $minute += 20);
            $minute += 15;



            $schedule[] = [
                'title' => $cTitle,
                'date_time_begin' => $cDate_time_begin,
                'date_time_end' => $cDate_time_end,
            ];
        }

        DB::table('schedules')->insert($schedule);
    }
}
