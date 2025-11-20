


@extends('layouts.app')
@section('title','QrCode - Colaborador')
@section('content')
<h4>QrCode Colaborador</h4>
    {{ $colaborador->matricula }}
</h4>

<div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(250)->margin(2)->generate($colaborador->matricula) !!}
</div>
@endsection
