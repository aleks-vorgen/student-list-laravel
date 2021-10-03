<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Models\Faculty;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        $faculties = Faculty::all(['id', 'title']);
        $students = Student::all([
            'id',
            'name',
            'surname',
            'faculty_id',
            'course'
        ]);

        $students = DB::table('students')
            ->leftJoin('faculties', 'students.faculty_id', '=', 'faculties.id')
            ->select([
                'students.id',
                'students.name',
                'students.surname',
                'faculties.title',
                'students.course'
            ])->get();

        return response()->json([
            'students' => $students,
            'faculties' => $faculties
        ]);
    }

    /**
     * @param StudentRequest $request
     * @return JsonResponse
     */
    public function store(StudentRequest $request)
    {
        $faculties = Faculty::all(['id', 'title']);
        $student = Student::create($request->validated());
        return response()->json([
            'message' => 'Студент успешно добавлен',
            'student' => $student,
            'faculties' => $faculties,
        ]);
    }

    /**
     * @param Student $student
     * @return JsonResponse
     */
    public function show(Student $student)
    {
        return response()->json($student);
    }

    /**
     * @param StudentRequest $request
     * @param Student $student
     * @return JsonResponse
     */
    public function update(StudentRequest $request, Student $student)
    {
        $student->fill($request->validated())->save();
        return response()->json([
            'message' => 'Студент успешно обновлён',
            'student' => $student,
        ]);
    }

    /**
     * @param Student $student
     * @return JsonResponse
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json([
            'message' => 'Студент успешно удалён'
        ]);
    }
}
