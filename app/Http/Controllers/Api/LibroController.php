<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Libro;

class LibroController extends Controller
{
    //

    public function index(){
        $libros = Libro::all(); 
        return response()->json($libros);
    }
    public function store(Request $request){
        $validated = $request->validate([
        'titulo' => 'required|string',
        'autor' => 'required|string',
        'genero' => 'nullable|string',
        'anio_publicacion' => 'nullable|integer',
        ]); 
        // Crea el libro en la base de datos
        $libro = Libro::create($validated);
        // Retorna el libro creado con código 201 (Created)
        return response()->json($libro, 201);
    }
    public function show($id){
        $libro = Libro::findOrFail($id);
        return response()->json($libro, 200);   
    }
    public function update (Request $request , $id){
        $libro = Libro::findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'sometimes|required|string',
            'autor' => 'sometimes|required|string',
            'genero' => 'nullable|string',
            'anio_publicacion' => 'nullable|integer',
        ]);
        $libro->update($validated);
        
        return response()->json($libro, 200);
    }
    public function destroy($id){
        $libro = Libro::findOrFail($id);
        $libro->delete();
        return response()->json(null, 204); 
    }
}
