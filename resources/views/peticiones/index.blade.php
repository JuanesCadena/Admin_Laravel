@extends('layouts.public')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Estilos adicionales */
        .petition-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;

        }

        .petition-image {
            max-width: 100px;
            max-height: 100px;
            margin-right: 20px;
        }
    </style>
    </head>
    <body>
    <div class="container mt-5">
        <h1 class="text-center">Lista de Peticiones</h1>
        <ul class="list-group">
            @foreach($peticiones as $peticion)
                <li class=" petition-item card  ">
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Aquí puedes cargar la imagen correspondiente al peticionario -->
                            <img class="card-img-top img-responsive" src="{{asset('/peticiones/'. $peticion->files()->first()->name)}}" alt="Imagen de la petición">
                        </div>
                        <div class="col-md-9">
                            <h3 class="mb-2">{{ $peticion->titulo }}</h3>
                            <p>
                                {{ $peticion->descripcion }}
                            </p>
                            <p><strong>Firmantes:</strong> {{ $peticion->firmantes }}</p>
                            <p><strong>Estado:</strong> {{ $peticion->estado }}</p>
                        </div>
                        <a href="{{route('peticiones.show',$peticion->id)}}" class="btn btn-danger mt-3">Ver detalle</a>
                    </div>
                </li>
            @endforeach
                {!! $peticiones->links() !!}
        </ul>
    </div>
    <!-- Agrega enlaces a los archivos JavaScript de Bootstrap y jQuery (para funcionalidad de Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
@endsection
