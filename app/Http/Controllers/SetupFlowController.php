<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Produto;
use App\Models\Setup;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class SetupFlowController extends Controller
{
    public function index()
    {
        $setup = $this->currentSetup();
        return view('flow.index', [
            'setup' => $setup,
            'etapa1Completa' => $setup && $setup->etapa1_at,
            'etapa2Completa' => $setup && $setup->etapa2_at,
        ]);
    }

    public function reset()
    {
        Session::forget('current_setup_id');
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
        $setup = $this->currentSetup();
        if (!$setup) {
            $setup = Setup::create([
                'colaborador_id' => $colaborador->id,
                'produto_id' => null,
                'codigo_colaborador' => $data['codigo_colaborador'],
                'codigo_produto' => '',
                'started_at' => now(),
                'etapa1_at' => now(),
            ]);
            Session::put('current_setup_id', $setup->id);
        } else {
            $setup->update([
                'colaborador_id' => $colaborador->id,
                'codigo_colaborador' => $data['codigo_colaborador'],
                'etapa1_at' => now(),
            ]);
        }
        return view('flow.colaborador_detalhes', compact('colaborador', 'setup'));
    }

    public function scanProduto()
    {
        $setup = $this->currentSetup();
        if (!$setup || !$setup->etapa1_at) {
            return redirect()->route('flow.index')->with('error', 'Finalize a etapa 1 primeiro.');
        }
        return view('flow.scan_produto', compact('setup'));
    }

    public function processProduto(Request $request)
    {
        $data = $request->validate([
            'codigo_produto' => 'required|string',
            'torque_informado' => 'required|numeric',
        ], [
            'torque_informado.required' => 'Informe o torque antes de avançar.',
        ]);
        $produto = Produto::where('codigo', $data['codigo_produto'])->first();
        if (!$produto) {
            return back()->withErrors(['codigo_produto' => 'Produto (parafusadeira) não encontrado pelo código.']);
        }
        $setup = $this->currentSetup();
        if (!$setup) {
            return redirect()->route('flow.index')->with('error', 'Inicie o fluxo pela etapa 1.');
        }
        $setup->update([
            'produto_id' => $produto->id,
            'codigo_produto' => $data['codigo_produto'],
            'torque_informado' => $data['torque_informado'],
            'etapa2_at' => now(),
        ]);
        return view('flow.produto_detalhes', compact('produto', 'setup'));
    }

    public function concluir()
    {
        $setup = $this->currentSetup();
        if (!$setup || !$setup->etapa2_at || !$setup->torque_informado) {
            return redirect()->route('flow.index')->with('error', 'Etapas incompletas ou torque não informado.');
        }
        $setup->update([
            'finished_at' => now(),
        ]);
        Session::forget('current_setup_id');
        return redirect()->route('flow.index')->with('success', 'Setup concluído.');
    }

    protected function currentSetup(): ?Setup
    {
        $id = Session::get('current_setup_id');
        return $id ? Setup::find($id) : null;
    }
}
