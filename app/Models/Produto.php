<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'quantidade_estoque',
        'categoria_id',
        'codigo_sku',
        'imagem_url',
        'ativo',
    ];

    protected $casts = [
        'preco' => 'decimal:2',
        'ativo' => 'boolean',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}



