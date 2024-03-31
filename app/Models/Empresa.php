<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nome',
        'email',
        'telefone',
        'obs',
        'created_at',
        'updated_at',
    ];
}

