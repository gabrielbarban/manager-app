<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EntradasService;
use App\Services\UsuarioService;
use App\Services\EmpresaService;
use App\Services\ProdutoService;

class EntradasController extends Controller
{
    protected $entradasService;
    protected $usuarioService;
    protected $empresaService;
    protected $produtosService;

    public function __construct(EntradasService $entradasService, UsuarioService $usuarioService, EmpresaService $empresaService, ProdutoService $produtosService)
    {
        $this->entradasService = $entradasService;
        $this->usuarioService = $usuarioService;
        $this->empresaService = $empresaService;
        $this->produtosService = $produtosService;
    }

    public function index()
    {
        $logged = \Illuminate\Support\Facades\Session::get('logged');
        if(empty($logged) || $logged == 0 || $logged == '0'){
            session()->put('message', 'Usuário/senha expirado');
            return redirect('/login');
        }

        $entradas = $this->entradasService->listEntradas();
        return view('templatemo-js.entradas')->with('entradas', $entradas);
    }

    public function novo()
    {
        $logged = \Illuminate\Support\Facades\Session::get('logged');
        if(empty($logged) || $logged == 0 || $logged == '0'){
            session()->put('message', 'Usuário/senha expirado');
            return redirect('/login');
        }
        $usuarios = $this->usuarioService->listUsuarios();
        $clientes = $this->empresaService->listEmpresas();
        $produtos = $this->produtosService->listProdutos();
        return view('templatemo-js.novo-entrada')->with('usuarios', $usuarios)->with('clientes', $clientes)->with('produtos', $produtos);
    }

    public function save(Request $request)
    {
        $logged = \Illuminate\Support\Facades\Session::get('logged');
        if(empty($logged) || $logged == 0 || $logged == '0'){
            session()->put('message', 'Usuário/senha expirado');
            return redirect('/login');
        }

        $entrada = $this->entradasService->save($request);

        if((isset($request->id) && !empty($request->id))){
             return redirect('/entradas')->with('success', 'Registro atualizado com sucesso!')
                ->with('entrada', $entrada);
        } else{
            return redirect('/entradas')->with('success', 'Registro salvo com sucesso!')
                ->with('entrada', $entrada);
        }
    }

    public function get($id)
    {
        $logged = \Illuminate\Support\Facades\Session::get('logged');
        if(empty($logged) || $logged == 0 || $logged == '0'){
            session()->put('message', 'Usuário/senha expirado');
            return redirect('/login');
        }

        $entrada = $this->entradasService->get($id);

        return view('templatemo-js.edit-entrada')->with('entrada', $entrada);
    }
}
