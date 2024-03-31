<?php

namespace App\Repositories;

use App\Models\Usuario;

class AuthRepository
{
    public function login($data)
    {
        $email = $data->email;
        $senha = md5($data->senha);

        $response = Usuario::where("email", $email)->where("senha", $senha)->first();
        return $response;
    }
}
