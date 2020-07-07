@extends('layouts.app')

@guest
@section('botones')
<a href="{{ route('inicio.index') }}" class="btn btn-primary mr-2">Inicio</a>
@endsection
@else

@section('botones')
<a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2">Ver recetas</a>
@endsection

@endguest



@section('content')

<div class="col-md-8 mx-auto">

    <div class="card">


        <div class="card-header">

            <h1 class="text-center">{{$receta->titulo}}</h1>

        </div>

        <div class="card-body ">

            <P>
                <span class="font-weight-bold text-primary">
                    Fecha:
                </span>
    
                @php
                $fecha = $receta->created_at
                @endphp
    
                <fecha-receta fecha="{{$fecha}}"></fecha-receta>
            </P>

            <div class="imagen-receta">
                <img src="/storage/{{$receta->imagen}}" alt="" class="img-fluid">
            </div>
    
            <div class="receta-meta">
                <P class="mt-2">
                    <span class="font-weight-bold text-primary">
                        Escrito en:
                    </span>
                    <a class="text-dark" href="{{ route('categorias.show', ['categoriaReceta' => $receta->categoria->id]) }}">
                        {{ $receta->categoria->categoria }}
                    </a>
                </P>
    
                <p>
                    <span class="font-weight-bold text-primary">
                        {{-- TODO: mostrar el usuario --}}
                        Autor:
                    </span>
                    <a class="text-dark" href="{{ route('perfiles.show', ['perfil' => $receta->autor->id]) }}">
                        {{ $receta->autor->name }}
                    </a>
                </p>
    
                <div class="ingredientes">
                    <h2 class="my-3 text-primary">
                        Ingredientes
                    </h2>
    
                    {!! $receta->ingredientes !!} {{-- Se coloca en signo de admiracion cerrado para que no imprima el codigo html con el que se guardo --}}
    
                </div>
    
                <div class="preparacion">
                    <h2 class="my-3 text-primary">
                        Preparación
                    </h2>
    
                    {!! $receta->preparacion !!}
    
                </div>
    
                <div class="justify-content-center row text-center">
    
                    <like-button receta-id="{{$receta->id}}" like="{{$like}}" likes="{{$likes}}">
    
                    </like-button>
    
                </div>

    
            </div>

        </div>



    </div>

    @endsection