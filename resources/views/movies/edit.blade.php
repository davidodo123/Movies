@extends('layouts.app')

@section('content')
    <h1 class="mb-3">Edit movie</h1>

    <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input class="form-control" type="text" name="title" value="{{ old('title', $movie->title) }}">
            @error('title') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Synopsis</label>
            <textarea class="form-control" name="synopsis">{{ old('synopsis', $movie->synopsis) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Year</label>
            <input class="form-control" type="number" name="year" value="{{ old('year', $movie->year) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Director</label>
            <select class="form-select" name="director_id">
                @foreach($directors as $id => $name)
                    <option value="{{ $id }}" @selected(old('director_id', $movie->director_id) == $id)>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @error('director_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Poster (image)</label>

            @if($movie->path)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $movie->path) }}"
                         alt="{{ $movie->title }}"
                         style="height: 120px; border-radius: 8px;">
                </div>
            @endif

            <input class="form-control" type="file" name="image" accept="image/*">
            @error('image') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-primary" type="submit">Save changes</button>
    </form>
@endsection
