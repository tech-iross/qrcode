@extends('layouts.app')
@section('title','Novo Colaborador')
@section('content')
<h4>Novo Colaborador</h4>
<form method="POST" action="{{ route('colaboradores.store') }}">
    @include('colaboradores._form')
</form>
@endsection