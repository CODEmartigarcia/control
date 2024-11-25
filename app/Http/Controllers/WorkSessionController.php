<?php
namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\WorkSession;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
// use App\Models\User;
class WorkSessionController extends Controller
{
    public function start()
    {
        $user = Auth::user();

        // Iniciar una nueva jornada para el usuario
        WorkSession::create([
            'user_id' => $user->id,
            'start_time' => now(),
        ]);

        return redirect()->back()->with('status', 'Jornada iniciada.');
    }

    public function end(WorkSession $session)
    {
        if ($session->user_id !== Auth::id()) {
            abort(403, 'No tienes permisos para finalizar esta jornada.');
        }

        $startTime = $session->start_time;
        $endTime = now();

        if (!$startTime || !$endTime) {
            return redirect()->back()->withErrors('Error: tiempos inválidos para la sesión.');
        }

        // Calcula la duración y actualiza
        $duration = $endTime->diffInSeconds($startTime);

        $session->update([
            'end_time' => $endTime,
            'total_duration' => $duration,
        ]);

        return redirect()->back()->with('status', 'Jornada finalizada.');
    }








    // private function calculateDuration($start, $end)
    // {
    //     // Carbon Objects
    //     $startTime = \Carbon\Carbon::parse($start);
    //     $endTime = \Carbon\Carbon::parse($end);

    //     // Diferencia en minutos.
    //     return $endTime->diffInMinutes($startTime);
    // }

}
