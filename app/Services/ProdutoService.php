<?php

namespace App\Services;

use App\Repositories\ProdutoRepository;

class ProdutoService
{
    protected $produtoRepository;

    public function __construct(ProdutoRepository $produtoRepository)
    {
        $this->produtoRepository = $produtoRepository;
    }

    public function listProdutos()
    {
        return $this->produtoRepository->listProdutos();
    }

    public function calculaValor($produtos)
    {
        return $this->produtoRepository->calculaValor($produtos);
    }

    public function save($data)
    {
        return $this->produtoRepository->save($data);
    }

    public function get($id)
    {
        return $this->produtoRepository->get($id);
    }
}
