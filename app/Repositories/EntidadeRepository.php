<?php

namespace App\Repositories;

use App\Models\Entidade;

class EntidadeRepository
{
    public function listEntidades()
    {
        $entidades = Entidade::get();
        return $entidades;
    }

    public function save($data)
    {
        if (isset($data->id) && !empty($data->id)) {
            $entidade = Entidade::where("id", $data->id)->first();
        } else {
            $entidade = new Entidade();
        }

        $entidade->email = $data->email;
        $entidade->nome = $data->nome;
        $entidade->telefone = $data->telefone;
        $entidade->moeda = $data->moeda;
        $entidade->cnpj = $data->cnpj;
        $entidade->obs = $data->obs;
        $entidade->save();

        return $entidade;
    }

    public function get($id)
    {
        $entidade = Entidade::where("id", $id)->first();
        return $entidade;
    }
}
