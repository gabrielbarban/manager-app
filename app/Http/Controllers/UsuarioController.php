<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UsuarioService;

class UsuarioController extends Controller
{
    protected $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function index()
    {
        $usuarios = $this->usuarioService->listUsuarios();
        return view('templatemo-js.usuarios')->with('usuarios', $usuarios);
    }

    public function novo()
    {
        return view('templatemo-js.novo-usuario');
    }

    public function save(Request $request)
    {
        if($request->senha !== $request->senha2){
            return view('templatemo-js.novo-usuario');
        }

        $usuario = $this->usuarioService->save($request);
        return redirect('/usuarios')->with('success', 'Usuário salvo com sucesso!')
            ->with('usuario', $usuario);
    }
}
