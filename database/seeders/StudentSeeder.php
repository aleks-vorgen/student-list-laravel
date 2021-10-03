<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = [];

        for ($i = 1; $i <= 10; $i++) {
            $cName = "Имя Студента №".$i;
            $cSurname = "Фамилия Студента №".$i;
            $cCourse = random_int(1, 5);
            $cFaculty = random_int(1, 4);

            $students[] = [
                'name' => $cName,
                'surname' => $cSurname,
                'course' => $cCourse,
                'faculty_id' => $cFaculty,
            ];
        }

        DB::table('students')->insert($students);
    }
}
