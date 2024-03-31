<?php

namespace App\Services;

use App\Repositories\EmpresaRepository;

class EmpresaService
{
    protected $empresaRepository;

    public function __construct(EmpresaRepository $empresaRepository)
    {
        $this->empresaRepository = $empresaRepository;
    }

    public function listEmpresas()
    {
        return $this->empresaRepository->listEmpresas();
    }

    public function save($data)
    {
        return $this->empresaRepository->save($data);
    }

    public function get($id)
    {
        return $this->empresaRepository->get($id);
    }
}
