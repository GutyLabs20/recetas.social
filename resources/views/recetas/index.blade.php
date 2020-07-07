@extends('layouts.app')

@section('botones')
    @include('ui.navegacion')
@endsection

@section('content')

<h2 class="text-center p-2">Administra tus Recetas</h2>

<div class="col-md-8 mx-auto">

    <div class="card">

        <table class="table table-hover table-sm">
            <thead class="bg-primary">
                <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">Usuario Chef</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($recetas as $receta)
                <tr>
                    <td>{{ $receta->titulo }}</td>
                    <td>{{ $receta->user_id }}</td>
                    <td>{{ $receta->categoria->categoria }}</td>{{-- Cambie categoria_id por el metodo categoria --}}
                    <td width="50" class="text-center">
                        <div class="btn-group">

                            <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" class="btn btn-success btn-sm" title="Ver receta"> {{-- Se ingresa metodo route --}}
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="{{ route('recetas.edit', ['receta' => $receta->id]) }}" class="btn btn-warning btn-sm" title="Editar">
                                <i class="fas fa-clipboard"></i>
                            </a>

                            <a href="" class="btn btn-danger btn-sm" title="Eliminar">
                                <i class="fas fa-trash"></i>
                            </a>

                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

        <div class="col-12 mt-4 justify-content-center d-flex">
            {{ $recetas->links() }}
        </div>

        

        <div class="col-md-10 mx-auto bg-white p-3">
            <h2 class="text-center my-5">Recetas que te gustan</h2>

            @if ( count($usuario->meGusta) > 0 )
                
                <ul class="list-group">

                    @foreach ($usuario->meGusta as $receta)
                        
                        <li class="list-group-item d-flex justify-content-lg-between align-items-center">

                            <p> {{$receta->titulo}} </p>

                            <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" class="btn btn-info btn-sm" title="Ver receta"><i class="fas fa-eye"></i></a>
                        </li>

                    @endforeach

                </ul>

            @else

                <p class="text-center">
                    Aún no tienes recetas Guardadas
                    <small> Dale me gusta a las recetas y aparecerán aquí.</small>
                </p>
                
            @endif

        </div>

    </div>
</div>

@endsection