<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\Tipo;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::with('tipo')->get();
        $tipos = Tipo::all();
        return view('noticias.create', compact('noticias', 'tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_id' => 'required|exists:tipos,id',
            'nome' => 'required|string|max:255',
        ]);

        Noticia::create([
            'tipo_id' => $request->tipo_id,
            'nome' => $request->nome,
        ]);

        return response()->json(['success' => 'Anúncio criado com sucesso!']);
    }
}
