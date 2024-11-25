<nav>
    <ul>
        <!-- Opciones comunes -->
        <li><a href="{{ route('profile.edit') }}">Perfil</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Cerrar Sesión</button>
            </form>
        </li>

        @if (Auth::user()->role === 'admin')
            <!-- Opciones para Administradores -->
            <li><a href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
            <li><a href="{{ route('users.index') }}">Gestionar Usuarios</a></li>
            <li><a href="{{ route('users.create') }}">Crear Usuarios</a></li>
        @else
            <!-- Opciones para Usuarios -->
            <li><a href="{{ route('user.dashboard') }}">Dashboard Usuario</a></li>
            <li><a href="{{ route('user.sessions') }}">Mis Jornadas</a></li>
        @endif
    </ul>
</nav>