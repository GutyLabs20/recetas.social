<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }


    public function show(Perfil $perfil)
    {
        //Obtener las recetas con paginación
        $recetas = Receta::where('user_id', $perfil->user_id)->paginate(3);

        return view('perfiles.show', compact('perfil', 'recetas'));
    }

    public function edit(Perfil $perfil)
    {
        //Ejecutar el policy
        $this->authorize('view', $perfil);

        return view('perfiles.edit', compact('perfil'));
    }

    public function update(Request $request, Perfil $perfil)
    {
        //Ejecutar el policy
        $this->authorize('update', $perfil);
        //Validar
        $data = request()->validate([
            'nombre' => 'required',
            'biografia' => 'required'
        ]);
        
        //Si el usuario sube una imagen
        if ($request['imagen']) {
            //Agregar ruta para guardar imagen con el metodo storage de laravel
            $ruta_imagen = $request['imagen']->store('upload-perfiles', 'public');

            //Resize de la imagen
            $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(600, 600);
            $img->save();

            //Crear un arreglo de imagen
            $array_imagen = ['imagen' => $ruta_imagen];
        }

        //Asignar nombre
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        //Eliminar name de $data
        unset($data['nombre']);

        //Guardar una información
        //Asignar biografia e imagen
        auth()->user()->perfil()->update( array_merge(
            $data, 
            $array_imagen ?? []
        ) );

        return redirect()->action('RecetaController@index');
    }

}
