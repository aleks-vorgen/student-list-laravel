<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacultiesTimeRequest;
use App\Models\FacultiesTime;
use App\Models\Faculty;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class FacultiesTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $faculties = Faculty::all(['id', 'title']);

        $timetables = DB::table('faculties_times')
            ->leftJoin('faculties', 'faculties_times.faculty_id', '=', 'faculties.id')
            ->select([
                'faculties_times.id',
                'faculties_times.work_date',
                'faculties.title',
            ])->get();

        return response()->json([
            'timetables' => $timetables,
            'faculties' => $faculties
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FacultiesTimeRequest $request
     * @return JsonResponse
     */
    public function store(FacultiesTimeRequest $request)
    {
        $faculties = Faculty::all(['id', 'title']);
        $timetable = FacultiesTime::create($request->validated());
        return response()->json([
            'message' => 'Расписание успешно добавлено',
            'timetable' => $timetable,
            'faculties' => $faculties,
        ]);
    }

    /**
     * @param FacultiesTime $timetable
     * @return JsonResponse
     */
    public function show(FacultiesTime $timetable)
    {
        return response()->json($timetable);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FacultiesTimeRequest $request
     * @param FacultiesTime $timetable
     * @return JsonResponse
     */
    public function update(FacultiesTimeRequest $request, FacultiesTime $timetable)
    {
        $timetable->fill($request->validated())->save();
        return response()->json([
            'message' => 'Расписание успешно изменено',
            'timetable' => $timetable,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FacultiesTime $timetable
     * @return JsonResponse
     */
    public function destroy(FacultiesTime $timetable)
    {
        $timetable->delete();
        return response()->json([
            'message' => 'Расписание успешно удалено'
        ]);
    }
}
