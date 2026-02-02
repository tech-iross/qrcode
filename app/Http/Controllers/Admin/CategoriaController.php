<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaProduto;
use App\Models\Produto;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = CategoriaProduto::withCount('produtos')->get();
        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
        ]);
        CategoriaProduto::create($data);
        return redirect()->route('admin.categorias.index')->with('success', 'Categoria criada com sucesso.');
    }

    public function edit(CategoriaProduto $categoria)
    {
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, CategoriaProduto $categoria)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
        ]);
        $categoria->update($data);
        return redirect()->route('admin.categorias.index')->with('success', 'Categoria atualizada com sucesso.');
    }

    public function destroy(CategoriaProduto $categoria)
    {
        $categoria->delete();
        return redirect()->route('admin.categorias.index')->with('success', 'Categoria excluída com sucesso.');
    }
}
