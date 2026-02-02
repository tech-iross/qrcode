@extends('layouts.app')
@section('title','Parafusadeira Detalhes')
@section('content')
<h4>Parafusadeira Capturada</h4>
<ul class="list-group mb-3">
    <li class="list-group-item"><strong>Código:</strong> {{ $produto->codigo }}</li>
    <li class="list-group-item"><strong>Número Sequencial:</strong> {{ $produto->numero_sequencial }}</li>
    <li class="list-group-item"><strong>Posto:</strong> {{ $produto->posto }}</li>
    <li class="list-group-item"><strong>Linha:</strong> {{ $produto->linha }}</li>
    <li class="list-group-item"><strong>Setor:</strong> {{ $produto->setor }}</li>
    <li class="list-group-item"><strong>Torque Padrão:</strong> {{ $produto->torque_padrao ?? '---' }}</li>
</ul>
<div class="d-flex gap-2">
    <a href="{{ route('flow.index') }}" class="btn btn-secondary">Voltar ao Painel</a>
    <a href="{{ route('flow.checkpoint') }}" class="btn btn-primary">Avançar para CheckPoint (Questionário)</a>
</div>
@endsection