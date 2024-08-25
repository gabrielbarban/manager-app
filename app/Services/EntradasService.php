<?php

namespace App\Services;

use App\Repositories\TransacaoRepository;

class EntradasService
{
    protected $transacaoRepository;

    public function __construct(TransacaoRepository $transacaoRepository)
    {
        $this->transacaoRepository = $transacaoRepository;
    }

    public function listEntradas()
    {
        return $this->transacaoRepository->listEntradas();
    }

    public function save($data)
    {
        return $this->transacaoRepository->save($data);
    }

    public function get($id)
    {
        return $this->transacaoRepository->get($id);
    }
}
