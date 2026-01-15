@extends('layouts.app')

@section('body_class', 'directors-body')

@section('content')
    <h1 class="mb-3">Director</h1>

    <div class="card-movie mb-4">
        <h2 class="movie-title">{{ $director->name }}</h2>

        <p class="movie-meta mb-1">
            @if($director->country)
                Country: {{ $director->country }}
            @endif
            @if($director->birthdate)
                @if($director->country) · @endif
                Born: {{ $director->birthdate }}
            @endif
        </p>
    </div>

    <div class="page-card">
        <h3 class="mb-3">Movies</h3>

        @if($director->movies->isEmpty())
            <p class="text-muted">This director has no movies yet.</p>
        @else
            <ul class="list-group">
                @foreach($director->movies as $movie)
                    <li class="list-group-item d-flex justify-content-between align-items-center">

                        <div class="d-flex align-items-center gap-3">
                            @if($movie->path)
                                <img src="{{ asset('storage/' . $movie->path) }}"
                                     alt="{{ $movie->title }}"
                                     class="director-movie-poster">
                            @endif

                            <div>
                                <strong>{{ $movie->title }}</strong>
                                @if($movie->year)
                                    <span class="text-muted">({{ $movie->year }})</span>
                                @endif
                            </div>
                        </div>

                        <a href="{{ route('movies.show', $movie->id) }}"
                           class="btn btn-sm btn-outline-light">
                            View
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
