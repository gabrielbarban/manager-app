<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nome',
        'created_at',
        'updated_at',
    ];
}

