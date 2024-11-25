@extends('layouts.app')

@section('content')
<h1>Editar Usuario</h1>
<form action="{{ route('users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}" required>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}" required>
    </div>
    <div>
        <label for="dni">DNI</label>
        <input type="text" name="dni" id="dni" value="{{ $user->dni }}" required pattern="[0-9]{7,8}[A-Za-z]"
            title="Debe contener entre 7 y 8 números seguidos de una letra">
    </div>
    <div>
        <label for="role">Rol</label>
        <select name="role" id="role">
            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Usuario</option>
            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrador</option>
        </select>
    </div>
    <button type="submit">Actualizar</button>
</form>
@endsection