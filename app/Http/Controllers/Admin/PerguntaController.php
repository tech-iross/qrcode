<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pergunta;
use App\Models\Produto;
use App\Models\OpcaoPergunta;
use Illuminate\Http\Request;

class PerguntaController extends Controller
{
    public function index(Produto $produto)
    {
        $perguntas = $produto->perguntas()->with('opcoes')->get();
        return view('admin.perguntas.index', compact('produto', 'perguntas'));
    }

    public function create(Produto $produto)
    {
        return view('admin.perguntas.create', compact('produto'));
    }

    public function store(Request $request, Produto $produto)
    {
        $data = $request->validate([
            'texto' => 'required|string',
            'tipo' => 'required|in:texto,multipla_escolha',
            'opcoes' => 'nullable|array',
            'opcoes.*' => 'required_if:tipo,multipla_escolha|string',
        ]);

        $pergunta = $produto->perguntas()->create([
            'texto' => $data['texto'],
            'tipo' => $data['tipo'],
        ]);

        if ($data['tipo'] === 'multipla_escolha' && isset($data['opcoes'])) {
            foreach ($data['opcoes'] as $opcaoTexto) {
                $pergunta->opcoes()->create(['texto' => $opcaoTexto]);
            }
        }

        return redirect()->route('admin.perguntas.index', $produto)->with('success', 'Pergunta criada com sucesso.');
    }

    public function destroy(Pergunta $pergunta)
    {
        $produto = $pergunta->produto;
        $pergunta->delete();
        return redirect()->route('admin.perguntas.index', $produto)->with('success', 'Pergunta excluída.');
    }
}
