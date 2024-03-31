<?php

namespace App\Repositories;

use App\Models\Empresa;

class EmpresaRepository
{
    public function listEmpresas()
    {
        $empresas = Empresa::get();
        return $empresas;
    }

    public function save($data)
    {
        if(isset($data->id) && !empty($data->id)){
            $empresa = Empresa::where("id", $data->id)->first();
        } else{
            $empresa = new Empresa();
        }

        $empresa->email = $data->email;
        $empresa->nome = $data->nome;
        $empresa->telefone = $data->telefone;
        $empresa->obs = $data->obs;
        $empresa->save();
        
        return $empresa;
    }

    public function get($id)
    {
        $empresa = Empresa::where("id", $id)->first();
        return $empresa;
    }
}
