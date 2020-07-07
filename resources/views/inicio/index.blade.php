@extends('layouts.app')


@section('hero')
    <div class="hero-categorias">
        <form action="{{ route('buscar.show') }}" class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-md-4 texto-buscar">
                    <p class="display-4">
                        Encuentra algo que preparar
                    </p>
                    
                    <div class="input-group mb-3">

                        <input type="search" name="buscar" class="form-control" id="buscar" placeholder="Buscar Receta">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-search"></span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection


@section('content')


    <div class="container nuevas-recetas">

        <h2 class="titulo-categoria text-uppercase mb-4">Ultimas Recetas</h2>

        <div class="row">

            @foreach ($nuevas as $nueva)
                
                <div class="col-md-4">

                    <div class="card">

                        <img src="/storage/{{$nueva->imagen}}" class="card-img-top" alt="imagen receta">

                        <div class="card-body">

                            <h3>{{ Str::upper($nueva->titulo) }}</h3>

                            <p>
                                {{ Str::words( strip_tags( $nueva->preparacion ), 20) }}
                            </p>

                            <a href="{{route('recetas.show', ['receta' => $nueva->id])}}" class="btn btn-primary d-block font-weight-bold text-uppercase" title="Ver receta">
                                Ver receta <i class="fas fa-eye"></i>
                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>


    <div class="container">

        <h5 class="titulo-categoria text-uppercase mt-5 mb-4">
            Recetas más votadas
        </h5>

        <div class="row">
                
            @foreach ($votadas as $receta)
                    
                @include('ui.receta')

            @endforeach

        </div>

    </div>


    @foreach ($recetas as $item =>$grupo)
        
        <div class="container">

            <h5 class="titulo-categoria text-uppercase mt-5 mb-4">
                {{ str_replace('-', ' ', $item) }}
            </h5>

            <div class="row">

                @foreach ($grupo as $recetas)
                    
                    @foreach ($recetas as $receta)
                        
                        @include('ui.receta')

                    @endforeach

                @endforeach

            </div>

        </div>

    @endforeach

@endsection