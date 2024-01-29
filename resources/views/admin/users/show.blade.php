@extends('layouts.admin')
@section('content')

    <body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Detalle de Peticiones</h2>
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="row">
                <div class="col-md-3">
                    <!-- Aquí puedes cargar la imagen correspondiente al peticionario -->
                    <img class="card-img-top img-responsive" src="{{asset('/peticiones/'. $peticion->files()->first()->name)}}" alt="Imagen de la petición">
                </div>

                <div class="col-md-9">
                    <div class="card-body">
                        <h6 class="card-text mb-2 ">{{$peticion->titulo}}</h6>
                        <p class="card-text">{{$peticion->descripcion}}</p>
                        <p class="card-text">{{$peticion->firmantes}} <strong>han firmado esta petición</strong></p>

                    </div>
                    <a href="{{route('peticiones.firmar',$peticion->id)}}"  class="btn btn-success" onclick="event.preventDefault(); document.getElementById('firma-id').submit();">Firma esta petición</a>
                    <form id="firma-id" method ="POST"  action="{{route('peticiones.firmar',$peticion->id)}}" style="display: none;">
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Agregar el script de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>


@endsection
