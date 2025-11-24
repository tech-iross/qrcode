@extends('layouts.app')
@section('title','QR Code Colaborador')
@section('content')
<h4>QR Code do Colaborador</h4>
<p><strong>Matrícula:</strong> {{ $colaborador->matricula }}</p>
<p><strong>Nome:</strong> {{ $colaborador->nome }}</p>
<div class="p-3 bg-white border d-inline-block">
    {!! QrCode::size(250)->generate($colaborador->matricula) !!}
</div>
<div class="mt-3 d-flex gap-2">
    <a href="{{ route('colaboradores.index') }}" class="btn btn-secondary">Voltar</a>
    <button class="btn btn-outline-primary" onclick="window.print()">Imprimir</button>
</div>
@endsection
