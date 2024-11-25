@extends('layouts.app')
@php
    function formatDuration($seconds)
    {
        if (!is_numeric($seconds) || $seconds <= 0) {
            return 'Duración no válida';
        }

        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;

        $formatted = [];
        if ($hours > 0) {
            $formatted[] = "$hours horas";
        }
        if ($minutes > 0) {
            $formatted[] = "$minutes minutos";
        }
        if ($seconds > 0 || empty($formatted)) {
            $formatted[] = "$seconds segundos";
        }

        return implode(', ', $formatted);
    }
@endphp
@section('content')
<h1>Panel de Administración</h1>

<div>
    <h2>Gestión de Usuarios</h2>
    <a href="{{ route('users.index') }}">Ir a Gestión de Usuarios</a>
</div>

<div>
    <h2>Jornadas de la Última Semana</h2>
    <form method="POST" action="{{ route('admin.worksession.update') }}">
        @csrf
        @method('PATCH')

        @foreach ($dailyWorkSessions as $date => $sessions)
            <h3>{{ $date }} (Total: {{ formatDuration($sessions->sum('total_duration')) }})</h3>
            <div class="accordion">
                <button class="accordion-header" onclick="toggleAccordion(this)">
                    {{ $date }} (Total: {{ formatDuration($sessions->sum('total_duration')) }})
                </button>
                <div class="accordion-content">
                    <table>
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Duración</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sessions as $session)
                                <tr>
                                    <td>{{ $session->user->name }}</td>
                                    <td>
                                    <td><input type="datetime-local" name="start_time[{{ $session->id }}]"
                                            value="{{ $session->start_time->format('Y-m-d\TH:i') }}"></td>
                                    </td>
                                    <td><input type="datetime-local" name="end_time[{{ $session->id }}]"
                                            value="{{ $session->end_time ? $session->end_time->format('Y-m-d\TH:i') : '' }}">
                                    </td>
                                    </td>
                                    <td>{{ $session->total_duration ? formatDuration($session->total_duration) : 'Duración no válida' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach

        <button type="submit">Guardar Cambios</button>
    </form>
</div>

<script>
    function toggleAccordion(button) {
        const content = button.nextElementSibling;
        content.style.display = content.style.display === 'block' ? 'none' : 'block';
    }
</script>
@endsection