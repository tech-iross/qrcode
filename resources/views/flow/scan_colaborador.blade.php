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
    let html5QrCode = null;
    let isScanning = false;

    function onScanSuccess(decodedText) {
        document.getElementById('codigo_colaborador').value = decodedText;

        stopScanner().then(() => {
            document.getElementById('manualForm').submit();
        });
    }

    function onScanError(error) { }

    async function stopScanner() {
        if (html5QrCode && isScanning) {
            try {
                await html5QrCode.stop();
            } catch (e) {
                console.warn(e);
            }

            try {
                await html5QrCode.clear();
            } catch (e) {
                console.warn(e);
            }

            isScanning = false;
        }
    }

    async function startScanner() {
        await stopScanner();

        const container = document.getElementById("qr-reader");
        container.innerHTML = ""; // reseta div

        html5QrCode = new Html5Qrcode("qr-reader");

        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                html5QrCode.start(
                    devices[0].id,
                    { fps: 10, qrbox: 250 },
                    onScanSuccess,
                    onScanError
                )
                .then(() => isScanning = true)
                .catch(err => console.error(err));
            }
        })
        .catch(err => console.error(err));
    }

    startScanner();

    window.addEventListener('beforeunload', stopScanner);

</script>
@endpush