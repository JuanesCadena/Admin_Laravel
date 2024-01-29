@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Lista de Categorías</h2>

        <a href="crear.html" class="btn btn-success mb-3">Crear Categoría</a>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="#" class="btn btn-primary btn-sm">Editar</a>
                                <a href="#" class="btn btn-info btn-sm">Mostrar</a>
                                <a href="#" class="btn btn-danger btn-sm">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {!! $categorias->links() !!} <!-- Paginación -->
    </div>
@endsection
