<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'codigo',
        'numero_sequencial',
        'posto',
        'linha',
        'setor',
        'categoria_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaProduto::class, 'categoria_id');
    }

    public function perguntas()
    {
        return $this->hasManyThrough(Pergunta::class, CategoriaProduto::class, 'id', 'categoria_id', 'categoria_id', 'id');
    }

    public function checkpoints()
    {
        return $this->hasMany(CheckPoint::class);
    }
}
