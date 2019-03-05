<?php

namespace App\Http\Controllers\Categorias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categorias\Categoria;

class CategoriasController extends Controller
{
    public function filter (Request $request)
    {
        $query = Categoria::query();

        if($request->search) {
            $query->where('nome', 'LIKE', '%'.$request->search.'%');
        }

        $categorias = $query->orderBy('id', 'asc');

        return $categorias->get();
    }

    public function show ($categoria)
    {
        return Categoria::findOrFail($categoria);
    }

    public function store (Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|string',
        ]);

       try {
           $categoria = Categoria::create([
               'nome' => $request->nome,
           ]);
       } catch(\Illuminate\Database\QueryException $ex) {
           $categoria = $ex->getMessage();
       }

        return $categoria;
    }

    public function update (Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|string',
        ]);

        $categoria = Categoria::find($request->id);

        if ($categoria->nome != $request->nome) {
            $categoria->nome = $request->nome;
        }

        $categoria->save();

        return $categoria;
    }

    public function destroy ($categoria)
    {
        return Categoria::destroy($categoria);
    }

    public function count ()
    {
        return Categoria::count();
    }

}
