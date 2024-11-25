<?php

namespace App\Http\Controllers;

use App\Models\WorkSession;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $dailyWorkSessions = WorkSession::with('user')
            ->where('start_time', '>=', Carbon::now()->subWeek())
            ->orderBy('start_time')
            ->get()
            ->groupBy(function ($session) {
                return Carbon::parse($session->start_time)->format('Y-m-d');
            });

        return view('admin.dashboard', compact('dailyWorkSessions'));
    }

    public function updateWorkSession(Request $request)
    {
        foreach ($request->input('start_time', []) as $sessionId => $startTime) {
            $session = WorkSession::findOrFail($sessionId);

            try {
                // Parse input times
                $parsedStartTime = $startTime ? Carbon::parse($startTime) : null;
                $parsedEndTime = $request->input("end_time.$sessionId") ? Carbon::parse($request->input("end_time.$sessionId")) : null;

                // Validations
                if (!$parsedStartTime || !$parsedEndTime) {
                    throw new \Exception("Los valores de inicio o fin no son válidos para la sesión ID: $sessionId");
                }

                if (!$parsedEndTime->greaterThan($parsedStartTime)) {
                    throw new \Exception("La hora de fin debe ser mayor que la hora de inicio para la sesión ID: $sessionId");
                }

                // Calculate duration and force positive value
                $session->start_time = $parsedStartTime;
                $session->end_time = $parsedEndTime;
                $session->total_duration = abs($parsedEndTime->diffInSeconds($parsedStartTime));

                // Save session
                $session->save();
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'Error al procesar la fecha de la sesión ID ' . $sessionId . ': ' . $e->getMessage()]);
            }
        }

        return back()->with('status', 'Jornadas actualizadas con éxito.');
    }





}
