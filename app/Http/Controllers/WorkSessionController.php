<?php
namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\WorkSession;
use Illuminate\Support\Facades\Auth;
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
        // Validar que el usuario autenticado sea el propietario de la sesión
        if ($session->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para finalizar esta jornada.');
        }

        // Finalizar la jornada
        $session->update([
            'end_time' => now(),
            'total_duration' => now()->diff($session->start_time),
        ]);

        return redirect()->back()->with('status', 'Jornada finalizada.');
    }
}
