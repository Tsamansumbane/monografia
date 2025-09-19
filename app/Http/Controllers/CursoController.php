<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
    // Listar todos os cursos e mostrar a view create (principal)
    public function index()
    {
        $cursos = Curso::all();
        return view('cursos.create', compact('cursos'));
    }

    // Armazenar novo curso
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'minor1' => 'nullable',
            'minor2' => 'nullable',
        ]);

        $curso = Curso::create($request->all());
        return response()->json(['success' => true, 'curso' => $curso]);
    }

    // Retorna os dados de um curso específico para edição
    public function edit($id)
    {
        $curso = Curso::findOrFail($id);
        return response()->json($curso);
    }

    // Atualiza os dados do curso
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'minor1' => 'nullable',
            'minor2' => 'nullable',
        ]);

        $curso = Curso::findOrFail($id);
        $curso->update($request->all());

        return response()->json(['success' => true, 'curso' => $curso]);
    }

    // Apaga um curso
    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();
        return redirect()->back()->with('success', 'Curso apagado com sucesso!');
    }
}
