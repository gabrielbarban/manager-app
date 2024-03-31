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
        $logged = \Illuminate\Support\Facades\Session::get('logged');
        if(empty($logged) || $logged == 0 || $logged == '0'){
            session()->put('message', 'Usuário/senha expirado');
            return redirect('/login');
        }

        $usuarios = $this->usuarioService->listUsuarios();
        return view('templatemo-js.usuarios')->with('usuarios', $usuarios);
    }

    public function novo()
    {
        $logged = \Illuminate\Support\Facades\Session::get('logged');
        if(empty($logged) || $logged == 0 || $logged == '0'){
            session()->put('message', 'Usuário/senha expirado');
            return redirect('/login');
        }

        return view('templatemo-js.novo-usuario');
    }

    public function save(Request $request)
    {
        $logged = \Illuminate\Support\Facades\Session::get('logged');
        if(empty($logged) || $logged == 0 || $logged == '0'){
            session()->put('message', 'Usuário/senha expirado');
            return redirect('/login');
        }

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
        $logged = \Illuminate\Support\Facades\Session::get('logged');
        if(empty($logged) || $logged == 0 || $logged == '0'){
            session()->put('message', 'Usuário/senha expirado');
            return redirect('/login');
        }

        $usuario = $this->usuarioService->get($id);
        return view('templatemo-js.edit-usuario')->with('usuario', $usuario);
    }
}
