<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class TestRepository
{
    public function testDatabaseConnection()
    {
        try {
            DB::connection()->getPdo();
            return "Conexão com o banco de dados estabelecida com sucesso!";
        } catch (\Exception $e) {
            return "Erro ao conectar ao banco de dados: " . $e->getMessage();
        }
    }
}
