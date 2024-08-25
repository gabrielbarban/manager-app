<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TransacaoProduto extends Model
{
    protected $table = 'transacao_produtos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'transacao_id',
        'produto_id',
    ];
    public $timestamps = false;
}



