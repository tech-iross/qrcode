@extends('layouts.app')
@section('title','Fluxo de Leitura')
@section('content')
<?php /** @var $setup \App\Models\Setup|null */ ?>
<div class="row g-4">
    <div class="col-md-6">
        <div class="card card-stage {{ $etapa1Completa ? 'done' : 'pending' }}">
            <div class="card-body">
                <h5 class="card-title">Etapa 1 - Dados do Colaborador</h5>
                <p class="card-text">{{ $etapa1Completa ? 'Concluída' : 'Aguardando leitura do QR (matrícula).'}} </p>
                @if(!$etapa1Completa)
                    <a href="{{ route('flow.scan.colaborador') }}" class="btn btn-primary">Ler QR Colaborador</a>
                @else
                    <a href="{{ route('flow.scan.colaborador') }}" class="btn btn-outline-secondary">Releer</a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-stage {{ $etapa2Completa ? 'done' : 'pending' }}">
            <div class="card-body">
                <h5 class="card-title">Etapa 2 - Dados da Parafusadeira</h5>
                <p class="card-text">{{ !$etapa1Completa ? 'Aguardando etapa 1.' : ($etapa2Completa ? 'Concluída' : 'Aguardando leitura do QR e torque.') }}</p>
                @if($etapa1Completa && !$etapa2Completa)
                    <a href="{{ route('flow.scan.produto') }}" class="btn btn-primary">Ler QR Parafusadeira</a>
                @elseif($etapa2Completa)
                    <a href="{{ route('flow.scan.produto') }}" class="btn btn-outline-secondary">Releer</a>
                @endif
            </div>
        </div>
    </div>
</div>
<hr>
<div class="d-flex gap-2">
    <form method="POST" action="{{ route('flow.reset') }}">@csrf<button class="btn btn-warning" {{ !$setup ? 'disabled' : '' }}>Reiniciar Fluxo</button></form>
    <form method="POST" action="{{ route('flow.concluir') }}">@csrf
        <button class="btn btn-success" {{ ($etapa1Completa && $etapa2Completa) ? '' : 'disabled' }}>Concluir Setup</button>
    </form>
</div>
@if($setup)
    <div class="mt-4">
        <h6>Setup Em Andamento</h6>
        <ul class="list-group">
            <li class="list-group-item">ID: {{ $setup->id }}</li>
            <li class="list-group-item">Colaborador: {{ $setup->colaborador?->nome ?? '---' }}</li>
            <li class="list-group-item">Produto: {{ $setup->produto?->codigo ?? '---' }}</li>
            <li class="list-group-item">Torque Informado: {{ $setup->torque_informado ?? '---' }}</li>
        </ul>
    </div>
@endif
@endsection