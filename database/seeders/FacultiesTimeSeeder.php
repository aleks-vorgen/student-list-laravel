<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FacultiesTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faculties = Faculty::all(['id']);
        $timeTable = [];
        foreach ($faculties as $faculty) {
            $timeTable[] = [
                'work_date' => rand(1, 6),
                'faculty_id' => $faculty->id,
            ];
        }

        DB::table('faculties_times')->insert($timeTable);
    }
}
