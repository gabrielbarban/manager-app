<?php

namespace App\Services;

use App\Repositories\TransacaoRepository;

class SaidasService
{
    protected $transacaoRepository;

    public function __construct(TransacaoRepository $transacaoRepository)
    {
        $this->transacaoRepository = $transacaoRepository;
    }

    public function listSaidas()
    {
        return $this->transacaoRepository->listSaidas();
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
