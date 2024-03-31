<?php

namespace App\Repositories;

use App\Models\Categoria;

class CategoriaRepository
{
    public function listCategorias()
    {
        $categorias = Categoria::get();
        return $categorias;
    }

    public function save($data)
    {
        if(isset($data->id) && !empty($data->id)){
            $categoria = Categoria::where("id", $data->id)->first();
        } else{
            $categoria = new Categoria();
        }

        $categoria->nome = $data->nome;
        $categoria->save();
        
        return $categoria;
    }

    public function get($id)
    {
        $categoria = Categoria::where("id", $id)->first();
        return $categoria;
    }
}
