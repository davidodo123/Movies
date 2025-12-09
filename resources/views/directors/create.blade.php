@extends('layouts.app')

@section('body_class', 'directors-body')

@section('content')
    <h1 class="mb-3">Add director</h1>

    <form action="{{ route('directors.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Country</label>
            <input class="form-control" type="text" name="country" value="{{ old('country') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Birthdate</label>
            <input class="form-control" type="date" name="birthdate" value="{{ old('birthdate') }}">
        </div>

        <button class="btn btn-success" type="submit">Save</button>
    </form>
@endsection
