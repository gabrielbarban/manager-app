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
        if((isset($request->id) && !empty($request->id)) && ($request->senha !== $request->senha2)){
            return redirect('/usuario'.'/'.$request->id)->with('error', 'As senhas informadas não são iguais.');
        } elseif((!isset($request->id)) && ($request->senha !== $request->senha2)){
            return redirect('/usuario/novo')->with('error', 'As senhas informadas não são iguais.');
        }

        $usuario = $this->usuarioService->save($request);

        if((isset($request->id) && !empty($request->id))){
             return redirect('/usuarios')->with('success', 'Usuário atualizado com sucesso!')
                ->with('usuario', $usuario);
        } else{
            return redirect('/usuarios')->with('success', 'Usuário salvo com sucesso!')
                ->with('usuario', $usuario);
        }
    }

    public function get($id)
    {
        $usuario = $this->usuarioService->get($id);
        return view('templatemo-js.edit-usuario')->with('usuario', $usuario);
    }
}
