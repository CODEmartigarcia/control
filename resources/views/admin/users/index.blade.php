<h1>Usuarios</h1>

<!-- Filtro de búsqueda -->
<form method="GET" action="{{ route('admin.users.index') }}">
    <input type="text" name="search" placeholder="Buscar usuarios" value="{{ request('search') }}">
    <button type="submit">Buscar</button>
</form>

<!-- Tabla principal de usuarios -->
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <!-- CRUD Actions -->
                    <a href="{{ route('admin.users.edit', $user) }}">Editar</a>
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>

            <!-- Historial de jornadas del usuario -->
            <tr>
                <td colspan="4">
                    <h4>Jornadas de {{ $user->name }}</h4>
                    @if ($user->workSessions->isEmpty())
                        <p>No hay jornadas para este usuario.</p>
                    @else
                        <table>
                            <thead>
                                <tr>
                                    <th>Inicio</th>
                                    <th>Fin</th>
                                    <th>Duración</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->workSessions as $session)
                                    <tr>
                                        <td>{{ $session->start_time }}</td>
                                        <td>{{ $session->end_time ?? 'En curso' }}</td>
                                        <td>{{ $session->total_duration ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Paginación -->
{{ $users->links() }}