


@extends('layouts.app')
@section('title','QrCode - Produto')
@section('content')
<h4>QrCode Produto</h4>
    {{ $produto->codigo }}
</h4>

<div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(250)->margin(2)->generate($produto->codigo) !!}
</div>
@endsection
