@extends('layouts.app')
@section('title','Fluxo CheckPoint')
@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="card card-stage {{ $etapa1Completa ? 'done' : 'pending' }}">
            <div class="card-body">
                <h5 class="card-title">1. Colaborador</h5>
                <p class="card-text small">{{ $etapa1Completa ? 'OK' : 'Aguardando QR.'}} </p>
                @if(!$etapa1Completa)
                    <a href="{{ route('flow.scan.colaborador') }}" class="btn btn-primary btn-sm">Ler QR</a>
                @else
                    <button class="btn btn-success btn-sm" disabled>Concluído</button>
                    <a href="{{ route('flow.scan.colaborador') }}" class="btn btn-link btn-sm">Alterar</a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stage {{ $etapa2Completa ? 'done' : 'pending' }}">
            <div class="card-body">
                <h5 class="card-title">2. Produto</h5>
                <p class="card-text small">{{ !$etapa1Completa ? 'Bloqueado.' : ($etapa2Completa ? 'OK' : 'Aguardando QR.') }}</p>
                @if($etapa1Completa && !$etapa2Completa)
                    <a href="{{ route('flow.scan.produto') }}" class="btn btn-primary btn-sm">Ler QR</a>
                @elseif($etapa2Completa)
                    <button class="btn btn-success btn-sm" disabled>Concluído</button>
                    <a href="{{ route('flow.scan.produto') }}" class="btn btn-link btn-sm">Alterar</a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stage pending">
            <div class="card-body">
                <h5 class="card-title">3. CheckPoint</h5>
                <p class="card-text small">Questionário final do produto.</p>
                @if($etapa2Completa)
                    <a href="{{ route('flow.checkpoint') }}" class="btn btn-primary btn-sm">Realizar CheckPoint</a>
                @else
                    <button class="btn btn-secondary btn-sm" disabled>Aguardando etapa 2</button>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <form method="POST" action="{{ route('flow.reset') }}">@csrf<button class="btn btn-outline-warning btn-sm">Reiniciar Todo o Fluxo</button></form>
</div>
@endsection