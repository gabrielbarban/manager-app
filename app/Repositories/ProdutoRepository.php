<?php

namespace App\Repositories;

use App\Models\Produto;

class ProdutoRepository
{
    public function listProdutos()
    {
        $entidade_id = \Illuminate\Support\Facades\Session::get('entidade_id') ?? 1;
        $produtos = Produto::where('entidade_id', $entidade_id)->get();
        return $produtos;
    }

    public function calculaValor($produtos)
    {
        $valor = 0;
        foreach($produtos as $id_produto){
            $produto = Produto::where("id", $id_produto)->first();
            if(!empty($produto->preco)){
                $valor = $valor + $produto->preco;
            }
        }
        return $valor;
    }

    public function save($data)
    {
        $entidade_id = \Illuminate\Support\Facades\Session::get('entidade_id') ?? 1;

        if(isset($data->id) && !empty($data->id)){
            $produto = Produto::where('entidade_id', $entidade_id)->where("id", $data->id)->first();
        } else{
            $produto = new Produto();
        }

        $produto->nome = $data->nome;
        $produto->categoria_id = $data->categoria_id;
        $produto->descricao = $data->descricao ?? "";
        $produto->preco = $data->preco ?? 0;
        $produto->imagem_url = $data->imagem_url ?? "";
        $produto->ativo = ($data->ativo === "on") ? 1 : 0;
        $produto->entidade_id = $entidade_id;
        $produto->save();
        
        return $produto;
    }

    public function get($id)
    {
        $entidade_id = \Illuminate\Support\Facades\Session::get('entidade_id') ?? 1;
        $produto = Produto::where('entidade_id', $entidade_id)->where("id", $id)->first();
        return $produto;
    }
}
