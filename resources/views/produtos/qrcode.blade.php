


@extends('layouts.app')
@section('title','Novo Produto')
@section('content')
<h4>Novo Produto (Parafusadeira)</h4>
    QR Code do Produto {{ $produto->codigo }}
</h4>

<div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(250)->margin(2)->generate($produto->codigo) !!}
</div>
@endsection
