@extends('layouts.app')

@section('content')
<h1>Lista de Usuarios</h1>

<form method="GET" action="{{ route('users.index') }}">
    <input type="text" name="search" placeholder="Buscar usuarios" value="{{ request('search') }}">
    <button type="submit">Buscar</button>
</form>

<a href="{{ route('users.create') }}" class="btn btn-primary">Crear Nuevo Usuario</a>

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Administrador Asignado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->admin ? $user->admin->name : 'Sin asignar' }}</td>
                <td>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-secondary">Editar</a>
                    <form method="POST" action="{{ route('users.destroy', $user) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $users->links() }}
@endsection