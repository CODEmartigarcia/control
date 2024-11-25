<?php

namespace App\Http\Controllers;

use App\Models\WorkSession;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Jornadas de la última semana agrupadas por día
        $dailyWorkSessions = WorkSession::with('user')
            ->where('start_time', '>=', Carbon::now()->subWeek())
            ->orderBy('start_time')
            ->get()
            ->map(function ($session) {
                $startTime = $session->start_time;
                $endTime = $session->end_time ?? now();

                // Asegúrate de que $endTime sea mayor que $startTime
                if ($startTime > $endTime) {
                    [$startTime, $endTime] = [$endTime, $startTime];
                }

                // Calcula la duración en horas con una precisión positiva
                $session->calculated_duration = $endTime->diffInHours($startTime);
                return $session;
            })
            ->groupBy(function ($session) {
                return Carbon::parse($session->start_time)->format('Y-m-d');
            });

        return view('admin.dashboard', compact('dailyWorkSessions'));
    }

}
