@extends('layouts.app')
@section('title','Editar Produto')
@section('content')
<h4>Editar Produto</h4>
<form method="POST" action="{{ route('produtos.update', $produto) }}">
    @method('PUT')
    @include('produtos._form')
</form>
@endsection