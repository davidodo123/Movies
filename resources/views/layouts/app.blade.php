<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies - Inspirado en Letterboxd</title>
<link rel="stylesheet" href="{{ asset('asset/css/cinema.css') }}">
<body class="bg-dark text-white">
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('movies.index') }}" class="logo">MOVIES</a>

            <div class="nav-links">
                @auth
                <span>Hola, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-link">Cerrar sesión</button>
                </form>
                @else
                <a href="{{ route('login') }}">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="btn-green">Crear cuenta</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>
</body>

</html>