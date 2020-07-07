<div class="col-md-4 mt-4">

    <div class="card shadow">

        <img class="card-img-top" src="/storage/{{$receta->imagen}}" alt="imagen receta">

        <div class="card-body">
            <h3 class="card-title">
                {{$receta->titulo}}
            </h3>

            <div class="meta-receta d-flex justify-content-between">
                @php
                    $fecha = $receta->created_at
                @endphp

                <p class="text-primary fecha font-weight-bold">
                    <fecha-receta fecha="{{$fecha}}"></fecha-receta>
                </p>

                <p>
                    {{count( $receta->likes )}} Les gustó
                </p>
            </div>

            <p class="card-text">
                {{ Str::words( strip_tags( $receta->preparacion ), 20) }}
            </p>

            <a href="{{route('recetas.show', ['receta' => $receta->id])}}" class="btn btn-primary d-block font-weight-bold text-uppercase" title="Ver receta">
                Ver receta <i class="fas fa-eye"></i>
            </a>

        </div>

    </div>

</div>