<?php

namespace App\Http\Controllers;

use App\Models\Monografia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MonografiaController extends Controller
{
    public function index()
    {
        $monografias = Monografia::get();
        return view('monografias.index', compact(['monografias']));
    }

    public function store(Request $request)
    {
        $ficheiro = request()->file('choosefile');
        $storage_path = "/monografias";
        $final_file_name = "";
        $status = false;

        if ($request->hasFile('choosefile')) {
            $file = $request->choosefile;
            $file_extension = $file->getClientOriginalExtension();
            $file_name = Str::random(5);
            $final_file_name = time() . "$file_name.$file_extension";

            $file->move(public_path($storage_path), $final_file_name);
        }

        $newMonografia = Monografia::create([
            'curso' => $request->curso,
            'ficheiro' => $storage_path . "/" . $final_file_name
        ]);

        if(!empty($newMonografia)){
            $message = "Documento carregado com sucesso";
            $status = true;
        } else {
            $message = "Ocorreu um erro ao tentar carregar documento.";
        }

        // Retorna também o curso para atualizar a tabela dinamicamente
        return response()->json([
            'status' => $status,
            'message' => $message,
            'file' => $final_file_name,
            'curso' => $request->curso
        ], 200);
    }
}