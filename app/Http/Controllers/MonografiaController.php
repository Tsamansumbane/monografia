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
        $storage_pah="/monografias";
        $final_file_name="";
        $status=false;

        if ($request->hasFile('choosefile')) {

            $file = $request->choosefile;
            $file_extension = $file->getClientOriginalExtension();
            $file_name = Str::random(5);
            $final_file_name = time() . "$file_name.$file_extension";

            $file->move(public_path($storage_pah), $final_file_name);
        }

        $newMonogrfia = Monografia::create([
            'curso' => $request->curso,
            'ficheiro' => $storage_pah."/".$final_file_name
        ]);

        if(!empty($newMonogrfia)){

            $message="Documento carregado com sucesso";
            $status=true;

        }else{

            $message="Ocorreu um erro ao tentar carregar documento.";

        }

        return response()->json(['status'=>$status,'message'=>$message],200);
    }
}
