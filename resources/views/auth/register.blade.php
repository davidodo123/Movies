@extends('layouts.app')

@section('content')
<div class="auth-container">
    <form action="{{ route('register') }}" method="POST" class="auth-form">
        @csrf
        <h2>Únete a la comunidad</h2>

        <div class="form-group">
            <label>Nombre de usuario</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Correo electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" required>
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Repetir contraseña</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn-submit">Registrarse</button>
    </form>
</div>
@endsection