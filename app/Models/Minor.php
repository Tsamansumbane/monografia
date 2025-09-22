<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minor extends Model
{
    use HasFactory;

    protected $fillable = ['curso_id', 'nome'];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
