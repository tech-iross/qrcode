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
    ];

    public function setups()
    {
        return $this->hasMany(Setup::class);
    }
}
