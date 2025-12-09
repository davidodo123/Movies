@extends('layouts.app')

@section('content')

    {{-- CARD PRINCIPAL DE LA PELI --}}
    <div class="card-movie mb-4 card-movie--stacked">

        @if($movie->path)
            <img src="{{ asset('storage/' . $movie->path) }}"
                 alt="{{ $movie->title }}"
                 class="movie-poster-large mb-3">
        @endif

        <h1 class="movie-title">{{ $movie->title }}</h1>

        <p class="movie-meta mb-1">
            {{ $movie->year }} · Directed by
            <a href="{{ route('directors.show', $movie->director->id) }}" class="link-warning text-decoration-none">
                {{ $movie->director->name }}
            </a>
        </p>

        <p class="mt-3">{{ $movie->synopsis }}</p>
    </div>

    {{-- LISTA DE REVIEWS --}}
    <h3 class="section-reviews-title">Reviews</h3>

    @forelse($movie->reviews as $review)
        <div class="review-block">
            <div class="review-header">
                <span class="review-author">{{ $review->author }}</span>

                @if($review->rating)
                    <span class="rating-badge">
                        <span class="star">★</span>{{ $review->rating }}/5
                    </span>
                @endif
            </div>

            <p class="review-text">{{ $review->text }}</p>
            <span class="review-date">{{ $review->created_at->format('d/m/Y H:i') }}</span>
        </div>
    @empty
        <p class="text-muted">No reviews yet.</p>
    @endforelse

    {{-- FORMULARIO PARA AÑADIR REVIEW --}}
    <h4 class="review-form-title mt-4">Add your review</h4>

    <form action="{{ route('movies.reviews.store', $movie->id) }}" method="POST" class="review-form">
        @csrf

        <div class="mb-3">
            <label class="form-label">Your name</label>
            <input type="text" name="author" class="form-control" value="{{ old('author') }}">
            @error('author') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Rating</label>
            <select name="rating" class="form-select">
                <option value="">Select rating</option>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" @selected(old('rating') == $i)>{{ $i }}</option>
                @endfor
            </select>
            <small>From 1 (worst) to 5 (best).</small>
            @error('rating') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Comment</label>
            <textarea name="text" class="form-control">{{ old('text') }}</textarea>
            @error('text') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Send review</button>
    </form>

@endsection
