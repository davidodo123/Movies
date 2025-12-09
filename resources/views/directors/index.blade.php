@extends('layouts.app')

@section('body_class', 'directors-body')

@section('content')
    <h1 class="mb-3">Directors</h1>

    <a href="{{ route('directors.create') }}" class="btn btn-success mb-3">Add director</a>

    @if($directors->isEmpty())
        <p>No directors yet.</p>
    @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Country</th>
                <th>Movies</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($directors as $director)
                <tr>
                    <td>{{ $director->name }}</td>
                    <td>{{ $director->country }}</td>
                    <td>{{ $director->movies_count }}</td>
                    <td>
                        <a href="{{ route('directors.show', $director->id) }}" class="btn btn-sm btn-primary">View</a>
                        <form action="{{ route('directors.destroy', $director->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete director?')">
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
