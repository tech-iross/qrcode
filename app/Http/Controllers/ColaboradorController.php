<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    public function index()
    {
        $colaboradores = Colaborador::orderBy('nome')->paginate(15);
        return view('colaboradores.index', compact('colaboradores'));
    }

    public function create()
    {
        return view('colaboradores.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'matricula' => 'required|string|unique:colaboradores,matricula',
            'nome' => 'required|string',
            'funcao' => 'required|string',
        ]);
        Colaborador::create($data);
        return redirect()->route('colaboradores.index')->with('success', 'Colaborador criado.');
    }

    public function edit(Colaborador $colaborador)
    {
        return view('colaboradores.edit', compact('colaborador'));
    }

    public function update(Request $request, Colaborador $colaborador)
    {
        $data = $request->validate([
            'matricula' => 'required|string|unique:colaboradores,matricula,' . $colaborador->id,
            'nome' => 'required|string',
            'funcao' => 'required|string',
        ]);
        $colaborador->update($data);
        return redirect()->route('colaboradores.index')->with('success', 'Colaborador atualizado.');
    }

    public function destroy(Colaborador $colaborador)
    {
        $colaborador->delete();
        return redirect()->route('colaboradores.index')->with('success', 'Colaborador removido.');
    }

    public function qrcode(Colaborador $colaborador)
    {
        return view('colaboradores.qrcode', compact('colaborador'));
    }
}
