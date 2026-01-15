@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Cartelera</h1>
        @auth
            <a href="{{ route('movies.create') }}" class="btn btn-primary">+ Añadir Película</a>
        @endauth
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Poster</th>
                    <th>Título</th>
                    <th>Año</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                <table class="table">
    <thead>
        <tr>
            <th>Poster</th>
            <th>Título</th>
            <th>Año</th>
            <th>Director</th> <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($movies as $movie)
        <tr>
            <td><img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->titulo }}" style="width: 100px;"></td>
            <td><strong>{{ $movie->title }}</strong></td>
            <td>{{ $movie->year }}</td>
            <td>{{ $movie->director->name ?? 'N/A' }}</td>
            <td>
                <a href="{{ route('movies.show', $movie) }}" class="btn btn-sm btn-outline-dark">Ver ficha</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4 d-flex justify-content-center">
    {{ $movies->links() }}
</div>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $movies->links() }}
    </div>
</div>
@endsection