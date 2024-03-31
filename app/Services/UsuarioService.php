<?php

namespace App\Services;

use App\Repositories\UsuarioRepository;

class UsuarioService
{
    protected $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function listUsuarios()
    {
        return $this->usuarioRepository->listUsuarios();
    }

    public function save($data)
    {
        return $this->usuarioRepository->save($data);
    }

    public function get($id)
    {
        return $this->usuarioRepository->get($id);
    }
}
