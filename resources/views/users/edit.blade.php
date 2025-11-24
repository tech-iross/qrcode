@extends('layouts.app')
@section('title','Editar Usuário')
@section('content')
<h4>Editar Usuário</h4>
<form method="POST" action="{{ route('users.update', $user) }}">
    @method('PUT')
    @include('users._form')
</form>
@endsection
