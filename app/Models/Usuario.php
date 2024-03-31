<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nome',
        'email',
        'senha',
        'created_at',
        'updated_at',
    ];
}

