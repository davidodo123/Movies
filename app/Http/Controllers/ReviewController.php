<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Movie $movie)
    {
        $data = $request->validate([
            'author' => 'required|string|max:100',
            'rating' => 'nullable|integer|min:1|max:5',
            'text'   => 'required|string|min:5',
        ]);

        $movie->reviews()->create($data);

        return back()->with(['general' => 'Review created correctly.']);
    }
}
