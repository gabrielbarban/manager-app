<?php

namespace App\Repositories;

use App\Models\Categoria;

class CategoriaRepository
{
    public function listCategorias()
    {
        $entidade_id = \Illuminate\Support\Facades\Session::get('entidade_id') ?? 1;
        $categorias = Categoria::where("entidade_id", $entidade_id)->get();
        return $categorias;
    }

    public function save($data)
    {
        $entidade_id = \Illuminate\Support\Facades\Session::get('entidade_id') ?? 1;
        if(isset($data->id) && !empty($data->id)){
            $categoria = Categoria::where("entidade_id", $entidade_id)
                        ->where("id", $data->id)->first();
        } else{
            $categoria = new Categoria();
        }

        $categoria->nome = $data->nome;
        $categoria->entidade_id = $entidade_id;
        $categoria->save();
        
        return $categoria;
    }

    public function get($id)
    {
        $entidade_id = \Illuminate\Support\Facades\Session::get('entidade_id') ?? 1;
        $categoria = Categoria::where("entidade_id", $entidade_id)
                            ->where("id", $id)->first();
        return $categoria;
    }
}
