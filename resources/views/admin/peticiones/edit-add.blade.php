@extends('layouts.admin')
@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Nueva Petición</h2>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('peticiones.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título</label>
                                <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" id="titulo">
                                @error('titulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion"></textarea>
                                @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="destinatario" class="form-label">Destinatario</label>
                                <textarea name="destinatario" class="form-control @error('destinatario') is-invalid @enderror" id="destinatario" required></textarea>
                                @error('destinatario')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="category">Categoría</label>
                                <select name="category" class="form-control">
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="file" class="form-label">Sube una imagen</label>
                                <input name="file" type="file" class="form-control-file @error('file') is-invalid @enderror" id="file" aria-describedby="fileHelp">
                                @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Enviar petición</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
