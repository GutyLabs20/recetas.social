<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        //Mostrar recetas por cantidad de votos
        // $votadas = Receta::has('likes', '>', 0)->get(); //Metodo para busqueda
        $votadas = Receta::withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get();

        //obtener las recetas mas nuevas
        // $nuevas = Receta::orderBy('created_at', 'ASC')->get(); esto es igual a la instruccion de abajo
        //latest: order by DESC | oldest: order by ASC
        $nuevas = Receta::latest()->take(6)->get();

        //Recetas por categorias
        $categorias = CategoriaReceta::all();

        //Agrupar recetas por categorias
        $recetas = [];

        foreach ($categorias as $categoria) {
            
            $recetas[ Str::slug($categoria->categoria) ][] = Receta::where('categoria_id', $categoria->id)->get();

        }

        
        return view('inicio.index', compact('nuevas', 'recetas', 'votadas'));
    }
}
