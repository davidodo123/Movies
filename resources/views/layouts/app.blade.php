<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movies App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('asset/css/cinema.css') }}">
</head>

<body class="@yield('body_class')">
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container d-flex justify-content-between align-items-center">
        {{-- IZQUIERDA: HOME + MI PERFIL --}}
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('movies.index') }}">MOVIES</a>


            <a href="{{ route('profile') }}">MI PERFIL</a>

            
        </div>

        {{-- DERECHA: ACCIONES --}}
        <div class="d-flex gap-2">
            <a class="btn btn-outline-light" href="{{ route('movies.create') }}">Add movie</a>
            <a class="btn btn-outline-light" href="{{ route('directors.index') }}">Directors</a>
        </div>
    </div>
</nav>



<div class="container">
    @if(session('general'))
        <div class="alert alert-success">
            {{ session('general') }}
        </div>
    @endif

    @yield('content')
</div>
</body>
</html>
