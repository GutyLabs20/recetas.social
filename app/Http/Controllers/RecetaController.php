<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'search']]); //Se pone como publico al metodo show para mostrar las recetas.
    }

    public function index()
    {
        // auth()->user()->recetas->dd(); //otra forma
        // $usuario = auth()->user();
        $usuario = auth()->user();


        //Recetas con paginacion
        $recetas = Receta::where('user_id', $usuario->id)->paginate(3);

        // $recetas = auth()->user()->recetas;

        return view('recetas.index')->with('recetas', $recetas)
                                    ->with('usuario', $usuario);

    }


    public function create()
    {
        // DB::table('categoria_receta')->get()->pluck('categoria', 'id')->dd();
        // Categorias sin modelo
        // $categorias = DB::table('categoria_recetas')->get();

        //Con modelo
        $categorias = CategoriaReceta::all(['id', 'categoria']);

        return view('recetas.create')->with(
            'categorias', $categorias
        );
    }


    public function store(Request $request)
    {
        $data = request()->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'ingredientes' => 'required',
            'preparacion' => 'required',
            'imagen' => 'required|image'
        ]);

        //Agregar ruta para guardar imagen con el metodo storage de laravel
        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

        //Resize de la imagen
        $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(900, 500);
        $img->save();

        // almacenar en la db - sin modelo
        // DB::table('recetas')->insert([
        //     'titulo' => $data['titulo'],
        //     'ingredientes' => $data['ingredientes'],
        //     'preparacion' => $data['preparacion'],
        //     'imagen' => $ruta_imagen,
        //     'user_id' => Auth::user()->id,
        //     'categoria_id' => $data['categoria']
        // ]);

        // almacenar en la db - con modelo
        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'ingredientes' => $data['ingredientes'],
            'preparacion' => $data['preparacion'],
            'imagen' => $ruta_imagen,
            'categoria_id' => $data['categoria']
        ]);

        return redirect()->action('RecetaController@index');
    }


    public function show(Receta $receta)
    {
        setlocale(LC_ALL, 'es_ES');
        //Obtener si el usuario actual le gusta la receta y esta autenticado
        $like = ( auth()->user() ) ? auth()->user()->meGusta->contains($receta->id) : false;

        //Pasa la cantidad de like a la vista
        $likes = $receta->likes->count();

        return view('recetas.show', compact('receta', 'like', 'likes'));
    }


    public function edit(Receta $receta)
    {
        // Revisar el policy
        $this->authorize('view', $receta);

        //Con modelo
        $categorias = CategoriaReceta::all(['id', 'categoria']);

        return view('recetas.edit', compact('categorias', 'receta'));
    }


    public function update(Request $request, Receta $receta)
    {
        // Revisar el policy
        $this->authorize('update', $receta);

        //Validación
        $data = request()->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'ingredientes' => 'required',
            'preparacion' => 'required',
        ]);

        //Asignar los valores
        $receta->titulo = $data['titulo'];
        $receta->categoria_id = $data['categoria'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->preparacion = $data['preparacion'];

        $receta->save();

        return redirect()->action('RecetaController@index');
    }


    public function destroy(Receta $receta)
    {
        //return "adfasdfasdfd";
    }

    public function search(Request $request)
    {
        // $busqueda = $request['buscar'];
        $busqueda = $request->get('buscar');

        //filtrando con comodines mismo mysql  SQL
        $recetas = Receta::where('titulo', 'like', '%' . $busqueda . '%')->paginate(3);
        $recetas->appends(['buscar' => $busqueda]);

        return view('busquedas.show', compact('recetas', 'busqueda'));
    }
}
