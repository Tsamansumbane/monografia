<?php

namespace App\Http\Controllers;

use App\Models\Whitelist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WhitelistController extends Controller
{
    public function index () {

        $whitelist = Whitelist::all();
        return view('whitelist.index', compact('whitelist'));

    }

    public function store(Request $request) {

        /*$request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:255|unique:whitelist,telefone',
        ]);
 
        Whitelist::create($request->only('nome', 'telefone'));

        return redirect()->route('whitelist.index')->with('success', 'Número adicionado à whitelist com sucesso!'); */
        // Validação
    $validator = Validator::make($request->all(), [
        'nome' => 'required|string|max:255',
        'telefone' => 'required|string|max:15|unique:whitelist,telefone',
    ]);

    // Se a validação falhar
    if ($validator->fails()) {
        return redirect()
            ->back()
            ->withErrors($validator) // Envia os erros
            ->withInput()
            ->with('modal_open', true); // Manter o modal aberto
    }

    // Criar o registro
    Whitelist::create($request->only('nome', 'telefone'));

    // Enviar mensagem de sucesso
    return redirect()->route('whitelist.index')->with('success', 'Número adicionado à whitelist com sucesso!');
        
    }
}
