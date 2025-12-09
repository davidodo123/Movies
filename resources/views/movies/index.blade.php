@extends('layouts.app')

@section('content')
<h1 class="mb-3">Movies</h1>

@if($movies->isEmpty())
<p>No movies yet.</p>
@else
<table class="table table-striped">
    <thead>
        <tr>
            <th>Poster</th>
            <th>Title</th>
            <th>Year</th>
            <th>Director</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($movies as $movie)
        <tr>
            <td>
                @if($movie->path)
                <img src="{{ asset('storage/' . $movie->path) }}"
                    alt="{{ $movie->title }}"
                    style="height: 60px; width: auto; border-radius: 6px;">
                @else
                <span class="text-muted">No image</span>
                @endif
            </td>

            <td>{{ $movie->title }}</td>
            <td>{{ $movie->year }}</td>
            <td>{{ $movie->director->name }}</td>

            <td>
                <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-sm btn-primary">View</a>

                <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-sm btn-warning">Edit</a>

                <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete movie?')">
                        Delete
                    </button>
                </form>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection