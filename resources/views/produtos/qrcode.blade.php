<h3>QR Code do Produto {{ $produto->codigo }}</h3>

<div>
    {!! QrCode::size(250)->generate($produto->codigo) !!}
</div>
