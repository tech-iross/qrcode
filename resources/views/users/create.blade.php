@extends('layouts.app')
@section('title','Novo Usuário')
@section('content')
<h4>Novo Usuário</h4>
<form method="POST" action="{{ route('users.store') }}">
    @include('users._form')
</form>
@endsection
