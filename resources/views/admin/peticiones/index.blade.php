@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Lista de Peticiones</h2>

        <!-- Botón para abrir la vista de creación -->
        <a href="{{route('admin.peticiones.create')}}" class="btn btn-success mb-3">Crear Petición</a>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th>Imagen</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Destinatario</th>
                    <th>Firmantes</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($peticiones as $peticion)
                    <tr>
                        <td>
                            <img src="{{ asset('/peticiones/' . $peticion->files()->first()->name) }}" alt="Imagen de la petición" class="img-fluid petition-image" style="max-width: 100px; max-height: 100px;">
                        </td>
                        <td>{{ $peticion->titulo }}</td>
                        <td>{{ $peticion->descripcion }}</td>
                        <td>{{ $peticion->destinatario }}</td>

                        <td>{{ $peticion->firmantes }}</td>
                        <td>{{ $peticion->estado }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.peticiones.edit', ['id' => $peticion->id]) }}" class="btn btn-primary btn-sm">Editar</a>
                                <a href="{{ route('admin.peticiones.show', ['id' => $peticion->id]) }}" class="btn btn-info btn-sm">Mostrar</a>

                                <form action="{{ route('admin.peticiones.delete', ['id' => $peticion->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta petición?')">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {!! $peticiones->links() !!} <!-- Paginación -->
    </div>
@endsection
