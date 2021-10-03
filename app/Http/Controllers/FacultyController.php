<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacultyRequest;
use App\Models\Faculty;
use Illuminate\Http\JsonResponse;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $faculties = Faculty::all(['id', 'title', 'work_time']);

        return response()->json($faculties);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FacultyRequest $request
     * @return JsonResponse
     */
    public function store(FacultyRequest $request)
    {
        $faculties = Faculty::create($request->validated());
        return response()->json([
            'message' => 'Факультет успешно добавлен',
            'faculties' => $faculties,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Faculty $faculty
     * @return JsonResponse
     */
    public function show(Faculty $faculty)
    {
        return response()->json($faculty);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FacultyRequest $request
     * @param Faculty $faculty
     * @return JsonResponse
     */
    public function update(FacultyRequest $request, Faculty $faculty)
    {
        $faculty->fill($request->validated())->save();
        return response()->json([
            'message' => 'Факультет успешно обновлён',
            'student' => $faculty,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Faculty $faculty
     * @return JsonResponse
     */
    public function destroy(Faculty $faculty)
    {
        $faculty->forceDelete();
        return response()->json([
            'message' => 'Факультет успешно удалён'
        ]);
    }
}
