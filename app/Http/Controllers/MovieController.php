<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;



class MovieController extends Controller
{
    public function index()
{
    // Cambia ->get() por ->paginate(5) para que no falle el método links()
    $movies = \App\Models\Movie::with('director')->paginate(5); 
    return view('movies.index', compact('movies'));
}
    public function show(Movie $movie): View  //Cargamos las relaciones director y reviews para esta película

    {
        $movie->load('director', 'reviews'); //Cargamos las relaciones director y reviews para esta película
        return view('movies.show', compact('movie')); // Enviamos la película a la vista movies/show.blade.php

    }
    public function edit(Movie $movie): View //Obtenemos todos los directores en formato
    {
        $directors = Director::pluck('name', 'id');

        return view('movies.edit', compact('movie', 'directors'));
    }

    public function update(Request $request, Movie $movie): RedirectResponse //Obtenemos todos los directores en formato
    {
        $data = $request->validate([
            'title'       => 'required|string|min:2|max:100',
            'synopsis'    => 'nullable|string',
            'year'        => 'nullable|integer',
            'director_id' => 'required|exists:directors,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        //Actualizamos campos básicos
        $movie->fill($data);
        $result = $movie->save();

        //Si viene nueva imagen, la subimos
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            //Borrar la anterior
            if ($movie->path) {
                Storage::disk('public')->delete($movie->path);
            }

            $image    = $request->file('image');
            $fileName = $movie->id . '.' . $image->getClientOriginalExtension();

            $image->storeAs('images', $fileName, 'public');  //Guardamos la imagen en el disco 'public'
            $image->storeAs('images', $fileName, 'local');

            $movie->path = 'images/' . $fileName;
            $result      = $movie->save();
        }

        //Preparamos el mensaje según si se ha guardado bien o no
        $messageArray = [
            'general' => $result ? 'Movie edited correctly.' : 'Error editing movie.',
        ];

        if ($result) {
            return redirect()->route('movies.edit', $movie->id)->with($messageArray);
        } else {
            return back()->withInput()->withErrors($messageArray);
        }
    }


    public function create(): View //Muestra el formulario para crear una película nueva.
    {
        $directors = Director::pluck('name', 'id');
        return view('movies.create', compact('directors'));
    }

    public function store(Request $request): RedirectResponse //Procesa el formulario de creación de una película.
    {
        $data = $request->validate([
            'title'       => 'required|string|min:2|max:100',
            'synopsis'    => 'nullable|string',
            'year'        => 'nullable|integer',
            'director_id' => 'required|exists:directors,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        $result = false;
        $movie = new Movie($data); //Creamos un nuevo modelo Movie con los datos validados

        try {
            //Primero guardamos para tener ID
            $result = $movie->save();

            //Subir imagen si se ha enviado
            $path = $this->upload($request, $movie->id);
            if ($path !== null) {
                $movie->path = $path;
                $result = $movie->save();
            }

            $message = 'Movie created correctly.';
        } catch (\Exception $e) {
            $message = 'Se ha producido un error, en caso de que persista, consulte al administrador.';
        }

        $messageArray = ['general' => $message]; //Preparamos el mensaje para la sesión

        if ($result) {
            return redirect()->route('movies.index')->with($messageArray);
        } else {
            return back()->withInput()->withErrors($messageArray);
        }
    }


    public function destroy(Movie $movie): RedirectResponse //Elimina una película.
    {
        $movie->delete();

        return redirect()->route('movies.index')
            ->with(['general' => 'Movie deleted correctly']);
    }

    private function destroyImage($file): void //Elimina una imagen del almacenamiento
    {
        Storage::delete($file);
    }

    public function profile(): View //Aquí se muestra la última película creada
    {
        $movie = Movie::with('director')->latest()->first();

        if (!$movie) {
            abort(404);
        }

        return view('movies.profile', compact('movie'));
    }


    private function upload(Request $request, $id): ?string //Sube una imagen y devuelve la ruta que se debe guardar en BD
    {
        $path = null;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $fileName = $id . '.' . $image->getClientOriginalExtension();

            //Guardar en disco public
            $image->storeAs('images', $fileName, 'public');

            //Guardar también en disco local 
            $image->storeAs('images', $fileName, 'local');

            //Lo que guardamos en BD
            $path = 'images/' . $fileName;
        }

        return $path;
    }
}
