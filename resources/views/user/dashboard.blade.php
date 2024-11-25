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
                <td>{{ $session->start_time }}</td>
                <td>{{ $session->end_time ?? 'En curso' }}</td>
                <td>{{ $session->total_duration ?? 'N/A' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>