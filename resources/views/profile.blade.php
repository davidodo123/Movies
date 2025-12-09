@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Profile</h1>

    <div class="d-flex flex-column flex-md-row align-items-start gap-4">
        <div class="card-movie mb-4">
    @if($movie->path)
        <img
            src="{{ asset('storage/' . $movie->path) }}"
            alt="{{ $movie->title }}"
            class="profile-poster"
        >
    @endif

    <h1 class="profile-title">{{ $movie->title }}</h1>
    <p class="profile-meta">
        {{ $movie->year }} · Directed by
        <a href="{{ route('directors.show', $movie->director->id) }}">
            {{ $movie->director->name }}
        </a>
    </p>
    <p class="profile-synopsis">{{ $movie->synopsis }}</p>
</div>


        {{-- INFO DE LA PELI --}}
        <div>
            <h2 class="movie-title mb-2">{{ $movie->title }} ({{ $movie->year }})</h2>
            <p class="movie-meta mb-2">
                Directed by
                <a href="{{ route('directors.show', $movie->director->id) }}">
                    {{ $movie->director->name }}
                </a>
            </p>
            <p class="mt-3">
                {{ $movie->synopsis }}
            </p>
        </div>
    </div>
@endsection
