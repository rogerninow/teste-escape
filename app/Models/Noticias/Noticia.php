<?php

namespace App\Models\Noticias;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'noticias';
    protected $fillable = ['titulo', 'categoria_id', 'texto', 'url_foto'];
}
