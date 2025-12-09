<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DirectorController extends Controller
{
    public function index(): View //Muestra el listado de directores
    {
        $directors = Director::withCount('movies')->get();
        return view('directors.index', compact('directors')); // Enviamos la colección a la vista directors/index.blade.php
    }

    public function show(Director $director): \Illuminate\View\View //Muestra el detalle de un director
    {
        $director->load('movies');

        return view('directors.show', compact('director'));
    }

    public function create(): View //Muestra el formulario para crear un nuevo director
    {
        return view('directors.create');
    }

    public function store(Request $request): RedirectResponse //Procesa el formulario de creación de un director
    {
        $data = $request->validate([
            'name'      => 'required|string|min:2|max:100',
            'country'   => 'nullable|string|max:100',
            'birthdate' => 'nullable|date',
        ]);

        Director::create($data); //Creamos el director en la base de datos con los datos validados

        return redirect()->route('directors.index')
            ->with(['general' => 'Director created correctly']);
    }

    public function destroy(Director $director): RedirectResponse //Elimina un director.
    {
        $director->delete();

        return redirect()->route('directors.index')  //Redirigimos al índice con mensaje de confirmación
            ->with(['general' => 'Director deleted correctly']);
    }
}
