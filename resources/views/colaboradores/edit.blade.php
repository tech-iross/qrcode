@extends('layouts.app')
@section('title','Editar Colaborador')
@section('content')
<h4>Editar Colaborador</h4>
<form method="POST" action="{{ route('colaboradores.update', $colaborador) }}">
    @method('PUT')
    @include('colaboradores._form')
</form>
@endsection