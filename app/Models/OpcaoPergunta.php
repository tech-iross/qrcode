<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpcaoPergunta extends Model
{
    use HasFactory;

    protected $table = 'opcoes_perguntas';

    protected $fillable = ['pergunta_id', 'texto'];

    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class);
    }
}
