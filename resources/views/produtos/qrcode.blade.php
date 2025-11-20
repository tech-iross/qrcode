<h3>QR Code do Produto {{ $produto->codigo }}</h3>

<div>
    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(90)->generate($produto->codigo) !!}
</div>
