<?php

namespace App\Repositories;

use App\Models\Usuario;

class UsuarioRepository
{
    public function listUsuarios()
    {
        $entidade_id = \Illuminate\Support\Facades\Session::get('entidade_id') ?? 1;
        $usuarios = Usuario::where('entidade_id', $entidade_id)->get();
        return $usuarios;
    }

    public function save($data)
    {
        $entidade_id = \Illuminate\Support\Facades\Session::get('entidade_id') ?? 1;

        if(isset($data->id) && !empty($data->id)){
            $usuario = Usuario::where('entidade_id', $entidade_id)->where("id", $data->id)->first();
        } else{
            $usuario = new Usuario();
        }

        $usuario->email = $data->email;
        $usuario->senha = md5($data->senha);
        $usuario->nome = $data->nome;
        $usuario->entidade_id = $entidade_id;
        $usuario->save();
        
        return $usuario;
    }

    public function get($id)
    {
        $entidade_id = \Illuminate\Support\Facades\Session::get('entidade_id') ?? 1;
        $usuario = Usuario::where('entidade_id', $entidade_id)->where("id", $id)->first();
        return $usuario;
    }
}
