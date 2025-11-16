<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    use HasFactory;

    protected $fillable = [
        'colaborador_id',
        'produto_id',
        'codigo_colaborador',
        'codigo_produto',
        'started_at',
        'etapa1_at',
        'etapa2_at',
        'finished_at',
        'torque_informado',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'etapa1_at' => 'datetime',
        'etapa2_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
