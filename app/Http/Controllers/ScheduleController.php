<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {

        $schedule = DB::table('schedules')
            ->selectRaw('id')
            ->selectRaw('TIME(date_time_begin) AS time_begin')
            ->selectRaw('TIME(date_time_end) AS time_end')
            ->selectRaw('DATE(date_time_begin) AS date')
            ->selectRaw('DAYNAME(date_time_begin) AS day')
            ->selectRaw('title')
            ->get();
        return response()->json($schedule);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ScheduleRequest $request
     * @return JsonResponse
     */
    public function store(ScheduleRequest $request)
    {
        $schedule = new Schedule($request->validated());
        $date_time_end = Carbon::parse($request['time_begin'])->addHours(1)->addMinutes(20)->toTimeString();
        $date_time_end = Carbon::createFromFormat('H:i:s', $date_time_end)->toTimeString();
        $changes = [
            'date_time_begin' => $request['date'].' '.$request['time_begin'],
            'date_time_end' => $request['date'].' '.$date_time_end,
        ];
        $schedule->fill($changes)->save();

        return response()->json([
            'message' => 'Расписание успешно добавлено',
            'schedule' => $schedule,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Schedule $schedule
     * @return JsonResponse
     */
    public function show(Schedule $schedule)
    {
        $title = $schedule['title'];
        $time_begin = date('H:i', strtotime($schedule['date_time_begin']));
        $date = date('Y-m-d', strtotime($schedule['date_time_begin']));
        $item = [
            'title' => $title,
            'time_begin' => $time_begin,
            'date' => $date
        ];
        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ScheduleRequest $request
     * @param Schedule $schedule
     * @return JsonResponse
     */
    public function update(ScheduleRequest $request, Schedule $schedule)
    {
        $schedule->fill($request->validated());
        $date_time_end = Carbon::parse($request['time_begin'])->addHours(1)->addMinutes(20)->toTimeString();
        $date_time_end = Carbon::createFromFormat('H:i:s', $date_time_end)->toTimeString();
        $changes = [
            'date_time_begin' => $request['date'].' '.$request['time_begin'],
            'date_time_end' => $request['date'].' '.$date_time_end,
        ];
        $schedule->fill($changes)->save();
        return response()->json([
            'message' => 'Расписание успешно изменено',
            'schedule' => $schedule,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Schedule $schedule
     * @return JsonResponse
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->forceDelete();
        return response()->json([
            'message' => 'Расписание успешно удалено',
        ]);
    }
}
