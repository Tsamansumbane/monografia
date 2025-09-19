<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    // Se quiseres relacionamento inverso com Noticia
    public function noticias()
    {
        return $this->hasMany(\App\Models\Noticia::class);
    }
}
