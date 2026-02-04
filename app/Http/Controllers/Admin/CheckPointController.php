<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckPoint;
use Illuminate\Http\Request;

class CheckPointController extends Controller
{
    public function index()
    {
        $checkpoints = CheckPoint::with(['colaborador', 'produto'])->latest()->get();
        return view('admin.checkpoints.index', compact('checkpoints'));
    }

    public function show(CheckPoint $checkpoint)
    {
        $checkpoint->load(['colaborador', 'produto', 'respostas.pergunta', 'respostas.opcaoSelecionada']);
        return view('admin.checkpoints.show', compact('checkpoint'));
    }

    public function pdf(CheckPoint $checkpoint)
    {
        $checkpoint->load(['colaborador', 'produto.categoria', 'respostas.pergunta', 'respostas.opcaoSelecionada']);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.checkpoints.pdf', compact('checkpoint'));
        return $pdf->download("checkpoint-{$checkpoint->id}.pdf");
    }
}
