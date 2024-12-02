@extends('layouts.app')

@section('content')
<h1>Historial de Jornadas</h1>

@if ($sessions->isEmpty())
    <p>No tienes jornadas registradas.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Duración</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sessions as $session)
                <tr>
                    <td>{{ $session->start_time }}</td>
                    <td>{{ $session->end_time ?? 'En curso' }}</td>
                    <td>
                        @if ($session->total_duration)
                            {{ gmdate('H:i:s', $session->total_duration) }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection