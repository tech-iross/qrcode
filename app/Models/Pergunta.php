<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    use HasFactory;

    protected $fillable = ['categoria_id', 'texto', 'tipo'];

    public function categoria()
    {
        return $this->belongsTo(CategoriaProduto::class, 'categoria_id');
    }

    public function opcoes()
    {
        return $this->hasMany(OpcaoPergunta::class);
    }

    public function respostas()
    {
        return $this->hasMany(CheckPointResposta::class, 'pergunta_id');
    }
}
