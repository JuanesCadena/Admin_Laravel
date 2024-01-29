@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Lista de Usuarios</h2>

        <a href="crear.html" class="btn btn-success mb-3">Crear Usuario</a>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody id="tablaUsuarios">
                <!-- Aquí se mostrarán los usuarios -->
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
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

        {!! $users->links() !!} <!-- Paginación -->
    </div>
@endsection
