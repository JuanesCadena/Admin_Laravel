<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Peticione;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;


class AdminPeticionesController extends Controller
{
    public function index()
    {
        $peticiones = Peticione::simplePaginate(5); // Obtener todas las peticiones
        return view('admin.peticiones.index', compact('peticiones'));
    }



    public function show($id)
    {
        $peticion = Peticione::findOrFail($id);
        return view('admin.peticiones.show', compact('peticion'));
    }





    public function delete($id)
    {
        $peticion = Peticione::findOrFail($id);
        $peticion->delete();

        return redirect()->route('admin.peticiones.index')->with('success', 'La petición ha sido eliminada correctamente');
    }

    public function create()
    {

        $categorias = Categoria::orderBy("nombre", "asc")->get();
        return view('admin.peticiones.edit-add', compact(var_name: 'categorias'));
    }


    public function edit($id)
    {
        $peticione = Peticione::findOrFail($id);
        $categorias = Categoria::orderBy("nombre", "asc")->get();

        return view('admin.peticiones.update', compact('peticione', 'categorias'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'destinatario' => 'required',
            'category' => 'required',
        ]);

        try {
            $category = Categoria::findOrFail($request->input('category'));
            $peticione = Peticione::findOrFail($id);
            $peticione->update([
                'titulo' => $request->input('titulo'),
                'descripcion' => $request->input('descripcion'),
                'destinatario' => $request->input('destinatario'),
            ]);
            $peticione->categoria()->associate($category);
            $peticione->save();

            return redirect()->route('admin.peticiones.index')->with('success', 'Petición actualizada correctamente.');
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }




    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'destinatario' => 'required',
            'category'=>'required',
            'file' => 'required',
        ]);
        $input = $request->all();
        try {
            $category = Categoria::findOrFail($input['category']);
            $user = Auth::user(); //asociarlo al usuario authenticado
            $peticion = new Peticione($input);
            $peticion->categoria()->associate($category);
            $peticion->user()->associate($user);
            $peticion->firmantes = 0;
            $peticion->estado = 'pendiente';
            $res=$peticion->save();
            if ($res) {
                $res_file = $this->fileUpload($request, $peticion->id);
                if ($res_file) {
                    return redirect('admin.peticiones.index');
                }
                return back()->withError( 'Error creando la peticion')->withInput();
            }
        }catch (\Exception $exception){
            return back()->withError( $exception->getMessage())->withInput();
        }
    }
    public function fileUpload(Request $req, $peticione_id=null){
        $file = $req->file('file');
        $fileModel = new File;
        $fileModel->peticione_id=$peticione_id;
        if($req->file('file')){
            $filename = $filename = time() . '_' . $file->getClientOriginalName();
            $file->move('peticiones',$filename);
            $fileModel->name=$filename;
            $fileModel->file_path=$filename;
            $res = $fileModel->save();
            return $fileModel;
            if($res){
                return 0;
            }else{
                return 1;
            }
        }
        return 1;
    }
}
