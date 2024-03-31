<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoriaService;

class CategoriaController extends Controller
{
    protected $categoriaService;

    public function __construct(CategoriaService $categoriaService)
    {
        $this->categoriaService = $categoriaService;
    }

    public function index()
    {
        $logged = \Illuminate\Support\Facades\Session::get('logged');
        if(empty($logged) || $logged == 0 || $logged == '0'){
            session()->put('message', 'Usuário/senha expirado');
            return redirect('/login');
        }

        $categorias = $this->categoriaService->listCategorias();
        return view('templatemo-js.categorias')->with('categorias', $categorias);
    }

    public function novo()
    {
        $logged = \Illuminate\Support\Facades\Session::get('logged');
        if(empty($logged) || $logged == 0 || $logged == '0'){
            session()->put('message', 'Usuário/senha expirado');
            return redirect('/login');
        }

        return view('templatemo-js.novo-categoria');
    }

    public function save(Request $request)
    {
        $logged = \Illuminate\Support\Facades\Session::get('logged');
        if(empty($logged) || $logged == 0 || $logged == '0'){
            session()->put('message', 'Usuário/senha expirado');
            return redirect('/login');
        }

        if((isset($request->id) && !empty($request->id)) && ($request->senha !== $request->senha2)){
            return redirect('/categoria'.'/'.$request->id)->with('error', 'As senhas informadas não são iguais.');
        } elseif((!isset($request->id)) && ($request->senha !== $request->senha2)){
            return redirect('/categoria/novo')->with('error', 'As senhas informadas não são iguais.');
        }

        $categoria = $this->categoriaService->save($request);

        if((isset($request->id) && !empty($request->id))){
             return redirect('/categorias')->with('success', 'Categoria atualizada com sucesso!')
                ->with('categoria', $categoria);
        } else{
            return redirect('/categorias')->with('success', 'Categoria salva com sucesso!')
                ->with('categoria', $categoria);
        }
    }

    public function get($id)
    {
        $logged = \Illuminate\Support\Facades\Session::get('logged');
        if(empty($logged) || $logged == 0 || $logged == '0'){
            session()->put('message', 'Usuário/senha expirado');
            return redirect('/login');
        }

        $categoria = $this->categoriaService->get($id);
        return view('templatemo-js.edit-categoria')->with('categoria', $categoria);
    }
}
