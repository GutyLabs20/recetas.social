@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css">
@endsection

@section('botones')
<a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2">Volver</a>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">


            <div class="card">

                <div class="card-header text-center">
                    <h1>Editar mi Perfil</h1>
                </div>
                <div class="card-body">
                    <h2 class="text-center mb-2 text-primary">{{$perfil->usuario->name}}</h2>

                    <form action="{{ route('perfiles.update', ['perfil' => $perfil->id]) }}" method="post" enctype="multipart/form-data" role="form">

                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">

                            <label for="nombre">Nombre: </label>
                            <input type="text" id="nombre" class="form-control @error('nombre') is-invalid @enderror" name="nombre" placeholder="tu nombre" value="{{ $perfil->usuario->name}}">

                            @error('nombre')
                            <span class="invalid-feedback d-block" role="alert">
                                {{$message}}
                            </span>
                            @enderror

                        </div>



                        <div class="form-group">

                            <label for="biografia">biografia: </label>

                            <input type="hidden" id="biografia" name="biografia" value="{{$perfil->biografia}}">

                            <trix-editor input="biografia" class="form-control @error('biografia') is-invalid @enderror trix-editor"></trix-editor>

                            @error('biografia')
                            <span class="invalid-feedback d-block" role="alert">
                                {{$message}}
                            </span>
                            @enderror

                        </div>


                        <div class="form-group mb-3">

                            <label for="imagen">Tu imagen: </label>

                            <input type="file" id="imagen" name="imagen" class="form-control @error('imagen') is-invalid @enderror">

                            @if ($perfil->imagen)

                                <div class="mt-4">
                                    <p>Imagen Actual:</p>
                                    <img src="/storage/{{$perfil->imagen}}" alt="" style="width: 300px">
                                </div>

                                @error('imagen')
                                <span class="invalid-feedback d-block" role="alert">
                                    {{$message}}
                                </span>
                                @enderror

                            @endif

                        </div>
                        

                        


                        <div class="row">

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-save"></i>
                                    Actualizar Perfil
                                </button>
                            </div>

                        </div>

                    </form>

                </div>



            </div>

        </div>

    </div>
</div>


@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js" defer></script>
@endsection