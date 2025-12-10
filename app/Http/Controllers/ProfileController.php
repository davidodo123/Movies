<?php


namespace App\Http\Controllers;

use App\Models\Movie;

class ProfileController extends Controller
{
    public function show()
    {
        //Muestro perfil como "perfil"
       
        $movie = Movie::latest()->first();

        return view('profile', compact('movie'));
    }
}
