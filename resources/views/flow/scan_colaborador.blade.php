@extends('layouts.app')
@section('title','Scan Colaborador')
@section('content')
<h4>Etapa 1 - Ler QR do Colaborador</h4>
<p>Clique para iniciar a câmera e ler a matrícula do colaborador.</p>
<div id="qr-reader" class="qr-container border bg-white p-2"></div>
<form id="manualForm" class="mt-3" method="POST" action="{{ route('flow.process.colaborador') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Matrícula (QR)</label>
        <input type="text" name="codigo_colaborador" id="codigo_colaborador" class="form-control" required>
    </div>
    <button class="btn btn-primary">Confirmar</button>
    <a href="{{ route('flow.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection
@push('scripts')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    function onScanSuccess(decodedText) {
        document.getElementById('codigo_colaborador').value = decodedText;
        document.getElementById('manualForm').submit();
    }
    function onScanError(error) { /* silencioso */ }
    const html5QrCode = new Html5Qrcode("qr-reader");
    Html5Qrcode.getCameras().then(devices => {
        if (devices && devices.length) {
            html5QrCode.start(devices[0].id, { fps:10, qrbox:250 }, onScanSuccess, onScanError);
        }
    }).catch(err => console.error(err));
</script>
@endpush