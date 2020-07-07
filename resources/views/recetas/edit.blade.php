@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css">
@endsection

@section('botones')
<a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2">Ver recetas</a>
@endsection

@section('content')

<h2 class="text-center p-2">Editar Receta: {{ $receta->titulo }}</h2>

<div class="row">
    <div class="col-md-6 mx-auto">

        <div class="card">

            <div class="card-body register-card-body">

                <form action="{{ route('recetas.update', ['receta' => $receta->id]) }}" method="post" enctype="multipart/form-data" role="form">

                    @csrf
                    @method('PUT')

                    <div class="input-group mb-3">

                        <input type="text" id="titulo" class="form-control @error('titulo') is-invalid @enderror" name="titulo" placeholder="Titulo Receta" value="{{ $receta->titulo }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-clipboard"></span>
                            </div>
                        </div>

                        @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            {{$message}}
                        </span>
                        @enderror

                    </div>

                    <div class="input-group mb-3">

                        
                        <label for="categoria" class="input-group ml-1">Categorias:</label>
                        

                        <select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror">
                            
                            <option value="">-- Seleccione --</option>

                            @foreach ($categorias as $item)
                            <option value="{{$item->id}}" {{ $receta->categoria_id == $item->id ? 'selected': ''}}>
                                {{$item->categoria}}
                            </option>
                            @endforeach
                        </select>
                        
                        @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            {{$message}}
                        </span>
                        @enderror
                        
                    </div>

                    <div class="form-group">

                        <label for="ingredientes">Ingredientes: </label>

                        <input type="hidden" id="ingredientes" name="ingredientes" value="{{ $receta->ingredientes }}">

                        <trix-editor input="ingredientes" class="form-control @error('ingredientes') is-invalid @enderror trix-editor"></trix-editor>
                        
                        @error('ingredientes')
                        <span class="invalid-feedback d-block" role="alert">
                            {{$message}}
                        </span>
                        @enderror

                    </div>

                    <div class="form-group mb-3">

                        <label for="preparacion">Preparación: </label>

                        <input type="hidden" id="preparacion" name="preparacion" value="{{ $receta->preparacion }}">

                        <trix-editor input="preparacion" class="form-control @error('ingredientes') is-invalid @enderror trix-editor"></trix-editor>
                        
                        @error('preparacion')
                        <span class="invalid-feedback d-block" role="alert">
                            {{$message}}
                        </span>
                        @enderror

                    </div>

                    <div class="form-group mb-3">

                        <label for="imagen">Elija imagen: </label>

                        <input type="file" id="imagen" name="imagen" class="form-control @error('imagen') is-invalid @enderror">
                        
                        <div class="mt-4">
                            <p>Imagen Actual:</p>
                            <img src="/storage/{{$receta->imagen}}" alt="" style="width: 300px">
                        </div>

                        @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            {{$message}}
                        </span>
                        @enderror

                    </div>


                    <div class="row">
                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-save"></i>
                                Actualizar
                            </button>
                        </div>

                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js" defer></script>
@endsection