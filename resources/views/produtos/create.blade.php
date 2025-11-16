@extends('layouts.app')
@section('title','Novo Produto')
@section('content')
<h4>Novo Produto (Parafusadeira)</h4>
<form method="POST" action="{{ route('produtos.store') }}">
    @include('produtos._form')
</form>
@endsection