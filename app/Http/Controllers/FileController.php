<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index(Request $request)
    {
        $peticiones = Peticione::all();
        return view('peticiones.index', compact('peticiones'));
    }

    public function download($filename){
        $path = public_path() . '/peticiones' . $filename;
        return $path;
    }

}
