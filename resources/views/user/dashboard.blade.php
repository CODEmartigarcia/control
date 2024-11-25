@if ($currentSession)
    <p>Sesión iniciada a las: {{ $currentSession->start_time }}</p>
    <form action="{{ route('worksession.end', $currentSession) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit">Finalizar Jornada</button>
    </form>
@else
    <form action="{{ route('worksession.start') }}" method="POST">
        @csrf
        <button type="submit">Iniciar Jornada</button>
    </form>
@endif

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
                <td>
                    {{ gmdate('H:i:s', $session->total_duration) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>