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
        'torque_padrao',
        'categoria_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaProduto::class, 'categoria_id');
    }

    public function perguntas()
    {
        return $this->hasMany(Pergunta::class);
    }

    public function checkpoints()
    {
        return $this->hasMany(CheckPoint::class);
    }
}
