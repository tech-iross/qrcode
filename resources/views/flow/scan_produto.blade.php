@extends('layouts.app')
@section('title','Scan Parafusadeira')
@section('content')
<h4>Etapa 2 - Ler QR da Parafusadeira</h4>
<p>Leia o QR da parafusadeira e informe o torque medido.</p>
<div id="qr-reader" class="qr-container border bg-white p-2"></div>
<form id="produtoForm" class="mt-3" method="POST" action="{{ route('flow.process.produto') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Código (QR)</label>
        <input type="text" name="codigo_produto" id="codigo_produto" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Torque Informado</label>
        <input type="number" step="0.01" name="torque_informado" class="form-control" required>
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
        document.getElementById('codigo_produto').value = decodedText;
    }

    function onScanError(error) { }

    function pickBackCamera(devices) {
        // tenta encontrar camera traseira / environment
        const regex = /(back|rear|environment|traseira)/i;
        const found = devices.find(d => regex.test(d.label));
        return found || devices[0];
    }

    function startScanner() {
        if (isScanning) return;

        const container = document.getElementById("qr-reader");
        container.innerHTML = "";

        if (html5QrCode) {
            try { html5QrCode.clear(); } catch(e) {}
        }

        html5QrCode = new Html5Qrcode("qr-reader");
        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                const cam = pickBackCamera(devices);
                html5QrCode.start(cam.id, { fps:10, qrbox:250 }, onScanSuccess, onScanError)
                    .then(() => { isScanning = true; })
                    .catch(err => console.error(err));
            }
        }).catch(err => console.error(err));
    }

    startScanner();

    document.getElementById('produtoForm').addEventListener('submit', (e) => {
        if (html5QrCode && isScanning) {
            e.preventDefault();
            html5QrCode.stop().then(() => {
                isScanning = false;
                e.target.submit();
            }).catch(err => {
                console.error(err);
                e.target.submit();
            });
        }
    });

    window.addEventListener('beforeunload', () => {
        if (html5QrCode && isScanning) {
            html5QrCode.stop().catch(err => console.error(err));
        }
    });
</script>
@endpush