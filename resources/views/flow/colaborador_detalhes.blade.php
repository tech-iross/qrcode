@extends('layouts.app')
@section('title','Colaborador Detalhes')
@section('content')
<h4>Colaborador Capturado</h4>
<ul class="list-group mb-3">
    <li class="list-group-item"><strong>Matrícula:</strong> {{ $colaborador->matricula }}</li>
    <li class="list-group-item"><strong>Nome:</strong> {{ $colaborador->nome }}</li>
    <li class="list-group-item"><strong>Função:</strong> {{ $colaborador->funcao }}</li>
</ul>
<div class="d-flex gap-2">
    <a href="{{ route('flow.index') }}" class="btn btn-secondary">Voltar</a>
    <a href="{{ route('flow.scan.produto') }}" class="btn btn-primary">Avançar para Etapa 2</a>
    <a href="{{ route('colaboradores.qrcode', $colaborador->id) }}" class="btn btn-outline-secondary">Ver QR do Colaborador</a>
</div>
@endsection