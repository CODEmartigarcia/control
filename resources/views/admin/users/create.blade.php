@extends('layouts.app')

@section('content')
<h1>Crear Usuario</h1>

@if (session('status'))
    <p class="text-success">{{ session('status') }}</p>
@endif

<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        @error('name')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        @error('email')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="dni">DNI</label>
        <input type="text" name="dni" id="dni" value="{{ old('dni') }}" required pattern="[0-9]{7,8}[A-Za-z]"
            title="Debe contener entre 7 y 8 números seguidos de una letra">
        @error('dni')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="role">Rol</label>
        <select name="role" id="role" required>
            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Usuario</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
        </select>
        @error('role')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="password">Contraseña (4 dígitos)</label>
        <input type="password" name="password" id="password" required pattern="\d{4}"
            title="Debe contener exactamente 4 dígitos">
        @error('password')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="password_confirmation">Confirmar Contraseña</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required pattern="\d{4}">
        @error('password_confirmation')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Crear Usuario</button>
</form>
@endsection