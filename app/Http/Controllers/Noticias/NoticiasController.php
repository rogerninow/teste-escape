<?php

namespace App\Http\Controllers\Noticias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Noticias\Noticia;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class NoticiasController extends Controller
{
    public function filter (Request $request)
    {
        $query = Noticia::query()
            ->leftJoin('categorias', 'categorias.id', '=', 'noticias.categoria_id')
            ->select('noticias.*', 'categorias.nome as categoria');

        if($request->search) {
            $query->where('noticias.titulo', 'LIKE', '%'.$request->search.'%');
        }

        $noticias = $query->orderBy('id', 'asc');

        return $noticias->get();
    }

    public function show ($noticia)
    {
        return Noticia::findOrFail($noticia);
    }

    public function store (Request $request)
    {
        $this->validate($request, [
            'titulo'        => 'required|string',
            'categoria_id'  => 'required|numeric',
            'texto'         => 'required|string'
        ]);

       try {
           $noticia = Noticia::create([
               'titulo'       => $request->titulo,
               'categoria_id' => $request->categoria_id,
               'texto'        => $request->texto,
               'url_foto'     => $request->url_foto
           ]);
       } catch(\Illuminate\Database\QueryException $ex) {
           $noticia = $ex->getMessage();
       }

        return $noticia;
    }

    public function update (Request $request)
    {
        $this->validate($request, [
            'titulo'        => 'required|string',
            'categoria_id'  => 'required|numeric',
            'texto'         => 'required|string'
        ]);

        $noticia = Noticia::find($request->id);

        if ($noticia->titulo != $request->titulo) {
            $noticia->titulo = $request->titulo;
        }

        if ($noticia->categoria_id != $request->categoria_id) {
            $noticia->categoria_id = $request->categoria_id;
        }

        if ($noticia->texto != $request->texto) {
            $noticia->texto = $request->texto;
        }

        if ($noticia->url_foto != $request->url_foto) {
            $noticia->url_foto = $request->url_foto;
        } else if ($noticia->url_foto == null) {
            $noticia->url_foto = '';
        }

        $noticia->save();

        return $noticia;
    }

    public function destroy ($noticia)
    {
        return Noticia::destroy($noticia);
    }

    public function upload (Request $request)
    {

        $this->validate($request, [
            'logo' => 'required|image64:jpeg,jpg,png'
        ]);

        $image = Image::make($request->get('logo'))->fit(500)->encode('jpg');
        $hash = md5($image->__toString());
        $path = "noticias/img/{$hash}.jpg";
        Storage::put($path, $image->__toString());

        return $path;

    }

    public function removelogo (Request $request)
    {
        if ($request->id) {
            $portal = Noticia::find($request->id);
            $portal->url_foto = null;
            $portal->save();
        }

        return Storage::delete($request->url) ? 'Removido' : 'Erro';
    }

    public function count ()
    {
        return Noticia::count();
    }

}
