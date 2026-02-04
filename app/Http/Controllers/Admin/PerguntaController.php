<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pergunta;
use App\Models\CategoriaProduto;
use App\Models\OpcaoPergunta;
use Illuminate\Http\Request;

class PerguntaController extends Controller
{
    public function index(CategoriaProduto $categoria)
    {
        $perguntas = $categoria->perguntas()->with('opcoes')->withCount('respostas')->get();
        return view('admin.perguntas.index', compact('categoria', 'perguntas'));
    }

    public function create(CategoriaProduto $categoria)
    {
        return view('admin.perguntas.create', compact('categoria'));
    }

    public function store(Request $request, CategoriaProduto $categoria)
    {
        $data = $request->validate([
            'texto' => 'required|string',
            'tipo' => 'required|in:texto,multipla_escolha',
            'opcoes' => 'nullable|array',
            'opcoes.*' => 'exclude_if:tipo,texto|required_if:tipo,multipla_escolha|nullable|string',
        ]);

        $pergunta = $categoria->perguntas()->create([
            'texto' => $data['texto'],
            'tipo' => $data['tipo'],
        ]);

        if ($data['tipo'] === 'multipla_escolha' && isset($data['opcoes'])) {
            $opcoes = array_filter($data['opcoes'], fn($opcao) => !empty(trim($opcao)));
            foreach ($opcoes as $opcaoTexto) {
                $pergunta->opcoes()->create(['texto' => $opcaoTexto]);
            }
        }

        return redirect()->route('admin.perguntas.index', $categoria)->with('success', 'Pergunta criada com sucesso.');
    }

    public function edit(Pergunta $pergunta)
    {
        $categoria = $pergunta->categoria;
        return view('admin.perguntas.edit', compact('pergunta', 'categoria'));
    }

    public function update(Request $request, Pergunta $pergunta)
    {
        $data = $request->validate([
            'texto' => 'required|string',
            'tipo' => 'required|in:texto,multipla_escolha',
            'opcoes' => 'nullable|array',
            'opcoes.*' => 'exclude_if:tipo,texto|required_if:tipo,multipla_escolha|nullable|string',
        ]);

        $pergunta->update([
            'texto' => $data['texto'],
            'tipo' => $data['tipo'],
        ]);

        if ($data['tipo'] === 'multipla_escolha' && isset($data['opcoes'])) {
            $pergunta->opcoes()->delete();
            $opcoes = array_filter($data['opcoes'], fn($opcao) => !empty(trim($opcao)));
            foreach ($opcoes as $opcaoTexto) {
                $pergunta->opcoes()->create(['texto' => $opcaoTexto]);
            }
        } else {
            $pergunta->opcoes()->delete();
        }

        return redirect()->route('admin.perguntas.index', $pergunta->categoria)->with('success', 'Pergunta atualizada com sucesso.');
    }

    public function destroy(Pergunta $pergunta)
    {
        if ($pergunta->respostas()->count() > 0) {
            return back()->with('error', 'Esta pergunta já possui respostas e não pode ser excluída.');
        }

        $categoria = $pergunta->categoria;
        $pergunta->delete();
        return redirect()->route('admin.perguntas.index', $categoria)->with('success', 'Pergunta excluída.');
    }
}
