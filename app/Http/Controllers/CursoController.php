<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Minor;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::with('minores')->get();
        return view('cursos.index', compact('cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'minor1' => 'required',
            'minor2' => 'required'
        ]);

        $curso = Curso::create(['nome' => $request->nome]);

        Minor::create([
            'curso_id' => $curso->id,
            'nome' => $request->minor1
        ]);

        Minor::create([
            'curso_id' => $curso->id,
            'nome' => $request->minor2
        ]);

        return redirect()->back()->with('success', 'Curso e minores registados com sucesso!');
    }
}
