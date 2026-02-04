<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckPointResposta extends Model
{
    use HasFactory;

    protected $table = 'checkpoint_respostas';

    protected $fillable = [
        'checkpoint_id',
        'pergunta_id',
        'resposta_texto',
        'opcao_selecionada_id',
    ];

    public function checkpoint()
    {
        return $this->belongsTo(CheckPoint::class);
    }

    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class);
    }

    public function opcaoSelecionada()
    {
        return $this->belongsTo(OpcaoPergunta::class, 'opcao_selecionada_id');
    }
}
