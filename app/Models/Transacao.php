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
        'cliente_id',
        'usuario_id',
        'data_liquidacao',
        'obs',
    ];
}



