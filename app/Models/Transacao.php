<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    protected $table = 'transacao';
    protected $primaryKey = 'id';
    protected $fillable = [
        'titulo',
        'desc',
        'transacao_tipo_id',
        'status',
        'valor',
        'empresa_id',
        'cliente_id',
        'usuario_id',
        'data_liquidacao',
        'obs',
    ];
}



