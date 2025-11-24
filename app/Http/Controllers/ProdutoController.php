<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::orderBy('codigo')->paginate(15);
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo' => 'required|string|unique:produtos,codigo',
            'numero_sequencial' => 'required|string',
            'posto' => 'required|string',
            'linha' => 'required|string',
            'setor' => 'required|string',
            'torque_padrao' => 'nullable|numeric',
        ]);
        Produto::create($data);
        return redirect()->route('produtos.index')->with('success', 'Produto criado.');
    }

    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, Produto $produto)
    {
        $data = $request->validate([
            'codigo' => 'required|string|unique:produtos,codigo,' . $produto->id,
            'numero_sequencial' => 'required|string',
            'posto' => 'required|string',
            'linha' => 'required|string',
            'setor' => 'required|string',
            'torque_padrao' => 'nullable|numeric',
        ]);
        $produto->update($data);
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado.');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto removido.');
    }

    public function qrcode(Produto $produto)
    {
        return view('produtos.qrcode', compact('produto'));
    }
}
