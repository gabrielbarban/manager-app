<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProdutoService;
use App\Services\CategoriaService;

class ProdutoController extends Controller
{
    protected $produtoService;
    protected $categoriaService;

    public function __construct(ProdutoService $produtoService, CategoriaService $categoriaService)
    {
        $this->produtoService = $produtoService;
        $this->categoriaService = $categoriaService;
    }

    public function index()
    {
        $logged = \Illuminate\Support\Facades\Session::get('logged');
        if(empty($logged) || $logged == 0 || $logged == '0'){
            session()->put('message', 'Usuário/senha expirado');
            return redirect('/login');
        }

        $produtos = $this->produtoService->listProdutos();
        return view('templatemo-js.produtos')->with('produtos', $produtos);
    }

    public function novo()
    {
        $logged = \Illuminate\Support\Facades\Session::get('logged');
        if(empty($logged) || $logged == 0 || $logged == '0'){
            session()->put('message', 'Usuário/senha expirado');
            return redirect('/login');
        }
        $categories = $this->categoriaService->listCategorias();
        return view('templatemo-js.novo-produto')->with('categories', $categories);
    }

    public function save(Request $request)
    {
        $logged = \Illuminate\Support\Facades\Session::get('logged');
        if(empty($logged) || $logged == 0 || $logged == '0'){
            session()->put('message', 'Usuário/senha expirado');
            return redirect('/login');
        }

        if((isset($request->id) && !empty($request->id)) && ($request->senha !== $request->senha2)){
            return redirect('/produto'.'/'.$request->id)->with('error', 'As senhas informadas não são iguais.');
        } elseif((!isset($request->id)) && ($request->senha !== $request->senha2)){
            return redirect('/produto/novo')->with('error', 'As senhas informadas não são iguais.');
        }

        $produto = $this->produtoService->save($request);

        if((isset($request->id) && !empty($request->id))){
             return redirect('/produtos')->with('success', 'Produto atualizado com sucesso!')
                ->with('produto', $produto);
        } else{
            return redirect('/produtos')->with('success', 'Produto salvo com sucesso!')
                ->with('produto', $produto);
        }
    }

    public function get($id)
    {
        $logged = \Illuminate\Support\Facades\Session::get('logged');
        if(empty($logged) || $logged == 0 || $logged == '0'){
            session()->put('message', 'Usuário/senha expirado');
            return redirect('/login');
        }

        $produto = $this->produtoService->get($id);
        return view('templatemo-js.edit-produto')->with('produto', $produto);
    }
}
