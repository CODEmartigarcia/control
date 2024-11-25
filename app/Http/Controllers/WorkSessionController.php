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

    // Calcula la duración correcta en segundos
    $startTime = Carbon::parse($session->start_time);
    $endTime = now();

    $durationInSeconds = $startTime->diffInSeconds($endTime);

    $session->update([
        'end_time' => $endTime,
        'total_duration' => $durationInSeconds,
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
