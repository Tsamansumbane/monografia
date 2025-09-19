<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::all();
        return view('cursos.create', compact('cursos')); // Mantendo create como principal
    }

    public function create()
    {
        return view('cursos.create'); // Opcional, mas podemos manter
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'minor1' => 'nullable',
            'minor2' => 'nullable',
        ]);

        Curso::create($request->all());

        return response()->json(['success' => 'Curso adicionado com sucesso!']);
    }
}
