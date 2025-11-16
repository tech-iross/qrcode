@extends('layouts.app')
@section('title','Setups')
@section('content')
<h4>Registros de Setups</h4>
<table class="table table-sm table-bordered align-middle">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Colaborador</th>
            <th>Produto</th>
            <th>Torque</th>
            <th>Início</th>
            <th>Fim</th>
            <th>Duração (min)</th>
            <th>Criado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($setups as $s)
        <tr>
            <td>{{ $s->id }}</td>
            <td>{{ $s->colaborador?->nome }}</td>
            <td>{{ $s->produto?->codigo }}</td>
            <td>{{ $s->torque_informado }}</td>
            <td>{{ $s->started_at?->format('d/m H:i') }}</td>
            <td>{{ $s->finished_at?->format('d/m H:i') }}</td>
            <td>{{ $s->started_at && $s->finished_at ? $s->started_at->diffInMinutes($s->finished_at) : '---' }}</td>
            <td>{{ $s->created_at->format('d/m/Y H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $setups->links() }}
@endsection