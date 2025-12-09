@extends('layouts.app')

@section('content')
<h1 class="mb-3">Add movie</h1>

<form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input class="form-control" type="text" name="title" value="{{ old('title') }}">
        @error('title') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Synopsis</label>
        <textarea class="form-control" name="synopsis">{{ old('synopsis') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Year</label>
        <input class="form-control" type="number" name="year" value="{{ old('year') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Director</label>
        <select class="form-select" name="director_id">
            @foreach($directors as $id => $name)
            <option value="{{ $id }}" @selected(old('director_id')==$id)>{{ $name }}</option>
            @endforeach
        </select>
        @error('director_id') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Poster (imagen)</label>
        <input class="form-control" type="file" name="image" accept="image/*">
        @error('image') <div class="text-danger">{{ $message }}</div> @enderror
    </div>


    <button class="btn btn-success" type="submit">Save</button>
</form>
@endsection