<?php

namespace App\Repositories;

use App\Models\Usuario;

class UsuarioRepository
{
    public function listUsuarios()
    {
        $usuarios = Usuario::get();
        return $usuarios;
    }

    public function save($data)
    {
        if(isset($data->id) && !empty($data->id)){
            $usuario = Usuario::where("id", $data->id)->first();
        } else{
            $usuario = new Usuario();
        }

        $usuario->email = $data->email;
        $usuario->senha = md5($data->senha);
        $usuario->nome = $data->nome;
        $usuario->save();
        
        return $usuario;
    }

    public function get($id)
    {
        $usuario = Usuario::where("id", $id)->first();
        return $usuario;
    }
}
