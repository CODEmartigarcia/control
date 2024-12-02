@if ($currentSession)
    <p>Jornada activa iniciada a las: {{ $currentSession->start_time }}</p>
    <form action="{{ route('worksession.end', $currentSession) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-danger">Finalizar Jornada</button>
    </form>
@else
    <form action="{{ route('worksession.start') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Iniciar Jornada</button>
    </form>
@endif

@php
    function formatDuration($seconds)
    {
        if (!is_numeric($seconds) || $seconds < 0) {
            return 'Duración no válida';
        }

        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;

        return sprintf('%d horas, %d minutos, %d segundos', $hours, $minutes, $seconds);
    }


@endphp

<h1>Tus Jornadas</h1>
<table>
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
                <!-- <td>{{ $session->start_time }}</td>
                                    <td>{{ $session->end_time ?? 'En curso' }}</td>
                                    <td>{{ gmdate('H:i:s', $session->total_duration) }}</td> -->
                <td>{{ $session->start_time->format('Y-m-d H:i:s') }}</td>
                <td>{{ $session->end_time ? $session->end_time->format('Y-m-d H:i:s') : 'En curso' }}</td>
                <!-- <td>{{ gmdate('H:i:s', $session->total_duration) }}</td> -->
                <td>{{ formatDuration(seconds: $session->total_duration) }}</td>

            </tr>
        @endforeach
    </tbody>
</table>