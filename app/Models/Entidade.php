<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entidade extends Model
{
    protected $table = 'entidade';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nome',
        'email',
        'telefone',
        'moeda',
        'tipo',
        'cnpj',
        'obs',
        'created_at',
        'updated_at',
    ];
}
