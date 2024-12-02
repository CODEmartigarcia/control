<?php

namespace App\Http\Controllers;

use App\Models\WorkSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function dashboard()
    {
        $currentSession = WorkSession::where('user_id', Auth::id())->whereNull('end_time')->first();
        $sessions = WorkSession::where('user_id', Auth::id())->get(); // Obtén todas las sesiones del usuario
        return view('user.dashboard', compact('currentSession', 'sessions'));
    }
    public function listSessions()
    {
        $sessions = WorkSession::where('user_id', Auth::id())
            ->orderBy('start_time', 'desc')
            ->get();

        return view('user.sessions', compact('sessions'));
    }



}