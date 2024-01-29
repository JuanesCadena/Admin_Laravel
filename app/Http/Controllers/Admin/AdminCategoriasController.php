<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class AdminCategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categoria::simplePaginate(); // Obtener todas las categorías
        return view('admin.categorias.index', compact('categorias')); // Pasar las categorías a la vista
    }
}
