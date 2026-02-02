<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    use HasFactory;

    protected $fillable = ['produto_id', 'texto', 'tipo'];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function opcoes()
    {
        return $this->hasMany(OpcaoPergunta::class);
    }
}
