<?php

namespace App\Repositories;

use App\Models\Empresa;

class EmpresaRepository
{
    public function listEmpresas()
    {
        $entidade_id = \Illuminate\Support\Facades\Session::get('entidade_id') ?? 1;
        $empresas = Empresa::where('entidade_id', $entidade_id)->get();
        return $empresas;
    }

    public function save($data)
    {
        $entidade_id = \Illuminate\Support\Facades\Session::get('entidade_id') ?? 1;
        if(isset($data->id) && !empty($data->id)){
            $empresa = Empresa::where('entidade_id', $entidade_id)->where("id", $data->id)->first();
        } else{
            $empresa = new Empresa();
        }

        $empresa->email = $data->email;
        $empresa->nome = $data->nome;
        $empresa->telefone = $data->telefone;
        $empresa->obs = $data->obs;
        $empresa->entidade_id = $entidade_id;
        $empresa->save();
        
        return $empresa;
    }

    public function get($id)
    {
        $entidade_id = \Illuminate\Support\Facades\Session::get('entidade_id') ?? 1;
        $empresa = Empresa::where('entidade_id', $entidade_id)->where("id", $id)->first();
        return $empresa;
    }
}
