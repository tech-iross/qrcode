@extends('layouts.app')
@section('title','QR Code Produto')
@section('content')
<h4>QR Code do Produto</h4>
<p><strong>Código:</strong> {{ $produto->codigo }}</p>
<div class="p-3 bg-white border d-inline-block">
    {!! QrCode::size(250)->generate($produto->codigo) !!}
</div>
<div class="mt-3 d-flex gap-2">
    <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar</a>
    <button class="btn btn-outline-primary" onclick="window.print()">Imprimir</button>
</div>
@endsection
