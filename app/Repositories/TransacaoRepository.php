<?php

namespace App\Repositories;

use App\Models\Transacao;
use App\Models\TransacaoProduto;

class TransacaoRepository
{
    public function listEntradas()
    {
        $entradas = Transacao::where("transacao_tipo_id", 1)->get();
        return $entradas;
    }

    public function listSaidas()
    {
        $saidas = Transacao::where("transacao_tipo_id", 2)->get();
        return $saidas;
    }

    public function save($data)
    {
        if(isset($data->id) && !empty($data->id)){
            $transacao = Transacao::where("id", $data->id)->first();
        } else{
            $transacao = new Transacao();
        }

        $transacao->titulo = $data->titulo ?? "";
        $transacao->desc = $data->desc ?? "";
        $transacao->transacao_tipo_id = $data->transacao_tipo_id ?? 0;
        $transacao->status = $data->status ?? "";
        $transacao->valor = $data->valor ?? 0;
        $transacao->cliente_id = $data->cliente_id ?? 0;
        $transacao->usuario_id = 1;
        $transacao->data_liquidacao = $data->data_liquidacao ?? null;
        $transacao->obs = $data->obs ?? "";
        $transacao->save();

        $transacaoProdutos = TransacaoProduto::where("transacao_id", $transacao->id)->get();
        foreach($transacaoProdutos as $tproduto){
            $tproduto->delete();
        }

        foreach($data->produto_id as $id){
            $transacaoProduto = new TransacaoProduto();
            $transacaoProduto->produto_id = $id;
            $transacaoProduto->transacao_id = $transacao->id;
            $transacaoProduto->save();
        }

        
        return $transacao;
    }

    public function get($id)
    {
        $transacao = Transacao::where("id", $id)->first();
        return $transacao;
    }
}
