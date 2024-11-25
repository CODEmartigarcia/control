@extends('layouts.app')

@section('content')
<h1>Panel de Administración</h1>

<div>
    <h2>Gestión de Usuarios</h2>
    <a href="{{ route('users.index') }}">Ir a Gestión de Usuarios</a>
</div>

<div>
    <h2>Jornadas de la Última Semana</h2>
    @foreach ($dailyWorkSessions as $date => $sessions)
        <h3>{{ $date }} (Total: {{ $sessions->sum('calculated_duration') }} horas)</h3>
        <div class="accordion">
            <button class="accordion-header" onclick="toggleAccordion(this)">
                {{ $date }} (Total: {{ $sessions->sum('total_duration') ?? '0' }} horas)
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
                                <td>{{ $session->start_time }}</td>
                                <td>{{ $session->end_time ?? 'En curso' }}</td>
                                <td>{{ $session->end_time ? gmdate('H:i:s', $session->calculated_duration) : 'En curso' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>

<script>
    function toggleAccordion(button) {
        const content = button.nextElementSibling;
        content.style.display = content.style.display === 'block' ? 'none' : 'block';
    }
</script>
@endsection