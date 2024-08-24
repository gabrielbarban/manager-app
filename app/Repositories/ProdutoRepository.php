<?php

namespace App\Repositories;

use App\Models\Produto;

class ProdutoRepository
{
    public function listProdutos()
    {
        $produtos = Produto::get();
        return $produtos;
    }

    public function save($data)
    {
        if(isset($data->id) && !empty($data->id)){
            $produto = Produto::where("id", $data->id)->first();
        } else{
            $produto = new Produto();
        }

        $produto->nome = $data->nome;
        $produto->categoria_id = $data->categoria_id;
        $produto->descricao = $data->descricao ?? "";
        $produto->preco = $data->preco ?? 0;
        $produto->imagem_url = $data->imagem_url ?? "";
        $produto->ativo = ($data->ativo === "on") ? 1 : 0;
        $produto->save();
        
        return $produto;
    }

    public function get($id)
    {
        $produto = Produto::where("id", $id)->first();
        return $produto;
    }
}
