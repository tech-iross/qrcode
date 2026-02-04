<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CheckPoint #{{ $checkpoint->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .section { margin-bottom: 20px; }
        .section-title { font-weight: bold; background: #eee; padding: 5px; margin-bottom: 10px; }
        .info-table { width: 100%; border-collapse: collapse; }
        .info-table td { padding: 5px; border: 1px solid #ddd; }
        .label { font-weight: bold; width: 30%; }
        .question-item { margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 5px; }
        .question-text { font-weight: bold; margin-bottom: 5px; }
        .answer { color: #555; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Relatório de CheckPoint</h1>
        <p>Gerado em: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="section">
        <div class="section-title">Informações Gerais</div>
        <table class="info-table">
            <tr>
                <td class="label">ID CheckPoint:</td>
                <td>#{{ $checkpoint->id }}</td>
            </tr>
            <tr>
                <td class="label">Colaborador:</td>
                <td>{{ $checkpoint->colaborador->nome }} ({{ $checkpoint->colaborador->matricula }})</td>
            </tr>
            <tr>
                <td class="label">Produto/Ferramenta:</td>
                <td>{{ $checkpoint->produto->codigo }} - {{ $checkpoint->produto->categoria->nome ?? 'Sem Categoria' }}</td>
            </tr>
            <tr>
                <td class="label">Iniciado em:</td>
                <td>{{ $checkpoint->started_at->format('d/m/Y H:i:s') }}</td>
            </tr>
            <tr>
                <td class="label">Finalizado em:</td>
                <td>{{ $checkpoint->finished_at ? $checkpoint->finished_at->format('d/m/Y H:i:s') : 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Duração:</td>
                <td>{{ $checkpoint->duracao }} segundos</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Questionário</div>
        @foreach($checkpoint->respostas as $resposta)
            <div class="question-item">
                <div class="question-text">{{ $loop->iteration }}. {{ $resposta->pergunta->texto }}</div>
                <div class="answer">
                    <strong>Resposta:</strong> 
                    @if($resposta->pergunta->tipo == 'texto')
                        {{ $resposta->resposta_texto }}
                    @else
                        {{ $resposta->opcaoSelecionada->texto ?? 'N/A' }}
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="footer">
        QR CheckPoint System &copy; {{ date('Y') }}
    </div>
</body>
</html>
