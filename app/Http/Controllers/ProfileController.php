<?php


namespace App\Http\Controllers;

use App\Models\Movie;

class ProfileController extends Controller
{
    public function show()
    {
        // Aquí decides qué película mostrar como "perfil"
       
        $movie = Movie::latest()->first();

        return view('profile', compact('movie'));
    }
}
