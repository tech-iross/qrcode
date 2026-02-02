<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'colaborador_id',
        'produto_id',
        'started_at',
        'finished_at',
        'duracao',
    ];

    protected $casts = [
        'started_at' => 'datetime',
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

    public function respostas()
    {
        return $this->hasMany(CheckPointResposta::class, 'checkpoint_id');
    }
}
