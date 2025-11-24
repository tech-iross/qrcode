


@extends('layouts.app')
@section('title','QR Code Produto')
@section('content')
<h4>QR Code do Produto</h4>
<p><strong>Código:</strong> {{ $produto->codigo }}</p>
<div id="qrcode" class="p-3 bg-white border" style="width:260px"></div>
<div class="mt-3 d-flex gap-2">
    <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar</a>
    <button class="btn btn-outline-primary" onclick="window.print()">Imprimir</button>
    <button class="btn btn-outline-success" id="downloadBtn">Baixar PNG</button>
    <button class="btn btn-outline-dark" id="openNew">Abrir em Página</button>
 </div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-TnX0r28mSsqGQBd4qVQwVFQh5b1xoy6wYJ0G07Z0rZQ6f6DRvDq0WpIW9S8S7GkJX0rK9QZi3pC1K7lbndNrxw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const code = "{{ $produto->codigo }}";
        const qrcodeDiv = document.getElementById('qrcode');

        if (!qrcodeDiv) {
            console.error('Div qrcode não encontrada');
            return;
        }

        // Limpa conteúdo anterior se existir
        qrcodeDiv.innerHTML = '';

        try {
            const qr = new QRCode(qrcodeDiv, {
                text: code,
                width: 250,
                height: 250,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            console.log('QR Code gerado com sucesso:', code);
        } catch(e) {
            console.error('Erro ao gerar QR Code:', e);
        }

        function dataUrlFromCanvas() {
            const img = qrcodeDiv.querySelector('img');
            if (img) return img.src;
            const canvas = qrcodeDiv.querySelector('canvas');
            return canvas ? canvas.toDataURL('image/png') : null;
        }

        document.getElementById('downloadBtn').addEventListener('click', () => {
            const url = dataUrlFromCanvas();
            if (!url) {
                alert('QR Code ainda não foi gerado');
                return;
            }
            const a = document.createElement('a');
            a.href = url;
            a.download = 'produto-' + code + '.png';
            a.click();
        });

        document.getElementById('openNew').addEventListener('click', () => {
            const url = dataUrlFromCanvas();
            if (!url) {
                alert('QR Code ainda não foi gerado');
                return;
            }
            const w = window.open('', '_blank');
            w.document.write('<title>QR Produto '+code+'</title><img style="width:100%;max-width:500px" src="'+url+'" /><p>'+code+'</p>');
        });
    });
</script>
@endpush
