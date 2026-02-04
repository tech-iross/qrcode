<?php

namespace App\Http\Controllers;

use App\Models\CheckPoint;
use App\Models\CheckPointResposta;
use App\Models\Colaborador;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class CheckPointFlowController extends Controller
{
    public function index()
    {
        $colaborador_id = Session::get('current_colaborador_id');
        $produto_id = Session::get('current_produto_id');

        return view('flow.index', [
            'etapa1Completa' => (bool)$colaborador_id,
            'etapa2Completa' => (bool)$produto_id,
        ]);
    }

    public function reset()
    {
        Session::forget(['current_colaborador_id', 'current_produto_id', 'start_time']);
        return redirect()->route('flow.index');
    }

    public function scanColaborador()
    {
        return view('flow.scan_colaborador');
    }

    public function processColaborador(Request $request)
    {
        $data = $request->validate([
            'codigo_colaborador' => 'required|string',
        ]);
        $colaborador = Colaborador::where('matricula', $data['codigo_colaborador'])->first();
        if (!$colaborador) {
            return back()->withErrors(['codigo_colaborador' => 'Colaborador não encontrado pela matrícula.']);
        }
        
        Session::put('current_colaborador_id', $colaborador->id);
        Session::put('start_time', now());
        
        return view('flow.colaborador_detalhes', compact('colaborador'));
    }

    public function scanProduto()
    {
        return view('flow.scan_produto');
    }

    public function processProduto(Request $request)
    {
        $data = $request->validate([
            'codigo_produto' => 'required|string',
        ]);
        $produto = Produto::where('codigo', $data['codigo_produto'])->first();
        if (!$produto) {
            return back()->withErrors(['codigo_produto' => 'Produto não encontrado.']);
        }
        
        Session::put('current_produto_id', $produto->id);
        
        return redirect()->route('flow.checkpoint');
    }

    public function checkpoint()
    {
        $produto_id = Session::get('current_produto_id');
        if (!$produto_id) return redirect()->route('flow.index');
        
        $produto = Produto::with('categoria.perguntas.opcoes')->find($produto_id);
        
        return view('flow.checkpoint', compact('produto'));
    }

    public function storeCheckpoint(Request $request)
    {
        $colaborador_id = Session::get('current_colaborador_id');
        $produto_id = Session::get('current_produto_id');
        $start_time = Carbon::parse(Session::get('start_time'));
        
        $checkpoint = CheckPoint::create([
            'colaborador_id' => $colaborador_id,
            'produto_id' => $produto_id,
            'started_at' => $start_time,
            'finished_at' => now(),
            'duracao' => now()->diffInSeconds($start_time),
        ]);

        $respostas = $request->input('respostas', []);
        foreach ($respostas as $pergunta_id => $valor) {
            $pergunta = \App\Models\Pergunta::find($pergunta_id);
            if ($pergunta->tipo == 'multipla_escolha') {
                CheckPointResposta::create([
                    'checkpoint_id' => $checkpoint->id,
                    'pergunta_id' => $pergunta_id,
                    'opcao_selecionada_id' => $valor,
                ]);
            } else {
                CheckPointResposta::create([
                    'checkpoint_id' => $checkpoint->id,
                    'pergunta_id' => $pergunta_id,
                    'resposta_texto' => $valor,
                ]);
            }
        }

        Session::forget(['current_colaborador_id', 'current_produto_id', 'start_time']);
        
        return redirect()->route('flow.index')->with('success', 'CheckPoint realizado com sucesso!');
    }

    protected function currentCheckPoint()
    {
        return null; // Logic needs adjustment for the stateless-ish flow if not using ID in session early
    }
}
