<h3 style="text-align: center; margin-bottom: 20px;">
    QR Code do Produto {{ $produto->codigo }}
</h3>

<div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(250)->margin(2)->generate($produto->codigo) !!}
</div>
