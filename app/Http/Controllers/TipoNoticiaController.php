<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo;

class TipoNoticiaController extends Controller
{
    // Exibir formulário de criação (create.blade.php)
    public function createTipo()
    {
        $tipos = Tipo::all(); // Para listar os tipos existentes
        return view('tipos.create', compact('tipos'));
    }

    // Inserir um Tipo
    public function storeTipo(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255|unique:tipos,nome',
        ]);

        Tipo::create($validated);

        return redirect()->route('tipos.create')->with('success', 'Tipo adicionado com sucesso!');
    }
}
