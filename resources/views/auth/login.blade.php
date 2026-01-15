@extends('layouts.app')

@section('content')
<div class="auth-container">
    <form action="{{ route('login') }}" method="POST" class="auth-form">
        @csrf
        <h2>Iniciar sesión</h2>

        <div class="form-group">
            <label>Correo electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" required>
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn-submit">Entrar</button>
        <p>¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
    </form>
</div>
@endsection