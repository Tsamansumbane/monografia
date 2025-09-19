<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $fillable = ['tipo_id', 'nome'];

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }
}
