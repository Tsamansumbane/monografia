<?php

namespace App\Http\Controllers;

use App\Models\Monografia;
use App\Models\Curso;
use App\Models\Minor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MonografiaController extends Controller
{
    public function index()
    {
        $monografias = Monografia::with(['curso','minor'])->get();
        $cursos = Curso::all();
        return view('monografias.index', compact('monografias','cursos'));
    }

    // AJAX para retornar minors de um curso
    public function getMinors($curso_id)
    {
        $minors = Minor::where('curso_id', $curso_id)->get();
        return response()->json($minors);
    }

    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'minor_id' => 'required|exists:minors,id',
            'choosefile' => 'required|file'
        ]);

        $file = $request->choosefile;
        $fileName = time().'_'.Str::random(5).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('/monografias'), $fileName);

        $monografia = Monografia::create([
            'curso_id' => $request->curso_id,
            'minor_id' => $request->minor_id,
            'ficheiro' => '/monografias/'.$fileName
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Monografia registrada com sucesso!',
            'monografia' => $monografia
        ]);
    }
}
