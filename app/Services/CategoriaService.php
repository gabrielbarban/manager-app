<?php

namespace App\Services;

use App\Repositories\CategoriaRepository;

class CategoriaService
{
    protected $categoriaRepository;

    public function __construct(CategoriaRepository $categoriaRepository)
    {
        $this->categoriaRepository = $categoriaRepository;
    }

    public function listCategorias()
    {
        return $this->categoriaRepository->listCategorias();
    }

    public function save($data)
    {
        return $this->categoriaRepository->save($data);
    }

    public function get($id)
    {
        return $this->categoriaRepository->get($id);
    }
}
