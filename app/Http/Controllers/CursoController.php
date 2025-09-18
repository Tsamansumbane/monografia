<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo;
use App\Models\Noticia;

class CursoController extends Controller
{
    public function index () {

        $noticias = Noticia::all();
        return view('curso.create', compact('curso'));

    }
/*        public function index()
        {
            // Recupera todas as notícias com o relacionamento do tipo
            $noticias = Noticia::with('tipo')->get(); 
            return view('noticias.create', compact('noticias'));
        } */

        // Exibir formulário para criar um Tipo
        public function createTipo()
        {
            $tipo = Tipo::all();
            return view('tipos.create', compact('tipo'));
        }
    
        // Exibir formulário para criar uma Notícia
        public function createNoticia()
        {
            $tipos = Tipo::all(); // Pegar todos os tipos para o dropdown
            return view('noticias.create', compact('tipos'));
            
        }

        // Inserir um Tipo
        public function storeTipo(Request $request)
        {
            $validated = $request->validate([
                'nome' => 'required|string|max:255|unique:tipos,nome',
            ]);
    
            $tipo = Tipo::create($validated);
    
            return redirect()->route('tipos.create')->with('success', 'Tipo adicionados com sucesso!');
        }
    
        // Inserir uma Notícia
        public function storeNoticia(Request $request)
        {
            $validated = $request->validate([
                'tipo_id' => 'required|exists:tipos,id',
                'descricao' => 'required|string',
            ]);
    
            $noticia = Noticia::create($validated);
    
            // Enviar mensagem de sucesso
            return redirect()->route('noticias.create')->with('success', 'Tipo adicionados com sucesso!');
        }
}
